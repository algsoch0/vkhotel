<?php

namespace App\Http\Controllers\API;

use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomController
{
    /**
     * Get all available rooms with filters
     */
    public function index(Request $request): JsonResponse
    {
        $query = Room::query()
            ->where('is_available', true)
            ->orderBy('price');

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        // Filter by price range
        if ($request->has('min_price') && $request->has('max_price')) {
            $minPrice = (float) $request->input('min_price');
            $maxPrice = (float) $request->input('max_price');
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Filter by capacity
        if ($request->has('capacity')) {
            $capacity = (int) $request->input('capacity');
            $query->where('capacity', '>=', $capacity);
        }

        // Filter by check-in and check-out dates
        if ($request->has('check_in') && $request->has('check_out')) {
            $checkInDate = $request->input('check_in');
            $checkOutDate = $request->input('check_out');
            $query->availableForDates($checkInDate, $checkOutDate);
        }

        // Pagination
        $perPage = (int) $request->input('per_page', 15);
        $rooms = $query->paginate($perPage);

        return response()->json($rooms, 200);
    }

    /**
     * Get single room details with reviews
     */
    public function show(Room $room): JsonResponse
    {
        $room->load([
            'reviews' => function ($query) {
                $query->where('is_verified', true)
                    ->orderByDesc('created_at')
                    ->limit(10);
            }
        ]);

        return response()->json([
            'data' => $room,
            'average_rating' => $room->reviews->avg('rating') ?? 0,
            'total_reviews' => $room->reviews->count(),
        ], 200);
    }

    /**
     * Search rooms with advanced filters
     */
    public function search(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'type' => 'nullable|string',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
        ]);

        $rooms = Room::query()
            ->availableForDates($validated['check_in'], $validated['check_out'])
            ->byCapacity($validated['guests']);

        if ($request->has('type')) {
            $rooms->byType($validated['type']);
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $rooms->byPriceRange($validated['min_price'], $validated['max_price']);
        }

        return response()->json([
            'count' => $rooms->count(),
            'data' => $rooms->get(),
        ], 200);
    }

    /**
     * Get room availability calendar
     */
    public function availability(Room $room, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $bookings = $room->bookings()
            ->where('status', '!=', 'cancelled')
            ->whereBetween('check_in_date', [$validated['start_date'], $validated['end_date']])
            ->get();

        return response()->json([
            'room_id' => $room->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'bookings' => $bookings,
        ], 200);
    }
}
