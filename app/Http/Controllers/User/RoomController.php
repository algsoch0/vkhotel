<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'type' => ['nullable', 'string', 'max:50'],
            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'min:0'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'check_in' => ['nullable', 'date', 'after_or_equal:today'],
            'check_out' => ['nullable', 'date', 'after:check_in'],
            'guests' => ['nullable', 'integer', 'min:1'],
            'sort' => ['nullable', 'in:latest,price_low,price_high,popular'],
        ]);

        $query = Room::query()->where('is_available', true);

        // Filter by type
        if (!empty($validated['type'])) {
            $query->where('type', $validated['type']);
        }

        // Filter by price range
        if (!empty($validated['min_price'])) {
            $query->where('price', '>=', $validated['min_price']);
        }

        if (!empty($validated['max_price'])) {
            $query->where('price', '<=', $validated['max_price']);
        }

        // Filter by capacity
        if (!empty($validated['capacity'])) {
            $query->where('capacity', '>=', $validated['capacity']);
        }

        if (!empty($validated['guests'])) {
            $query->where('capacity', '>=', $validated['guests']);
        }

        // Filter available rooms for chosen date range.
        if (!empty($validated['check_in']) && !empty($validated['check_out'])) {
            $query->whereDoesntHave('bookings', function ($bookingQuery) use ($validated) {
                $bookingQuery
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->where('check_in_date', '<', $validated['check_out'])
                    ->where('check_out_date', '>', $validated['check_in']);
            });
        }

        switch ($validated['sort'] ?? 'latest') {
            case 'price_low':
                $query->orderBy('price');
                break;
            case 'price_high':
                $query->orderByDesc('price');
                break;
            case 'popular':
                $query->withCount('bookings')->orderByDesc('bookings_count');
                break;
            default:
                $query->latest();
                break;
        }

        $rooms = $query->paginate(9);
        $roomTypes = Room::distinct('type')->pluck('type');

        return view('user.rooms.index', compact('rooms', 'roomTypes'));
    }

    public function show(Room $room)
    {
        $relatedRooms = Room::query()
            ->where('id', '!=', $room->id)
            ->where('is_available', true)
            ->where(function ($query) use ($room) {
                $query->where('type', $room->type)
                    ->orWhereBetween('price', [$room->price * 0.8, $room->price * 1.2]);
            })
            ->latest()
            ->take(3)
            ->get();

        return view('user.rooms.show', compact('room', 'relatedRooms'));
    }

    public function checkAvailability(Request $request, Room $room)
    {
        $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $room->capacity
        ]);

        // Check if room is available for the selected dates
        $isAvailable = !$room->bookings()
            ->where(function($query) use ($request) {
                $query->whereBetween('check_in_date', [$request->check_in, $request->check_out])
                    ->orWhereBetween('check_out_date', [$request->check_in, $request->check_out])
                    ->orWhere(function($q) use ($request) {
                        $q->where('check_in_date', '<=', $request->check_in)
                            ->where('check_out_date', '>=', $request->check_out);
                    });
            })
            ->whereIn('status', ['confirmed', 'pending'])
            ->exists();

        if (!$isAvailable) {
            return response()->json(['available' => false, 'message' => 'Room not available for selected dates']);
        }

        $nights = now()->parse($request->check_in)->diffInDays(now()->parse($request->check_out));
        $totalPrice = $room->price * $nights;

        return response()->json([
            'available' => true,
            'total_price' => $totalPrice,
            'nights' => $nights
        ]);
    }
}