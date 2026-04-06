<?php

namespace App\Http\Controllers\API;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController
{
    /**
     * Get all bookings for logged-in user
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $bookings = Booking::with(['room', 'payment'])
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json($bookings, 200);
    }

    /**
     * Create a new booking
     */
    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        // Check room availability
        $room = Room::findOrFail($validated['room_id']);

        $isAvailable = !Booking::where('room_id', $room->id)
            ->where('status', '!=', 'cancelled')
            ->where('check_in_date', '<', $validated['check_out_date'])
            ->where('check_out_date', '>', $validated['check_in_date'])
            ->exists();

        if (!$isAvailable) {
            return response()->json([
                'message' => 'Room is not available for the selected dates',
            ], 409);
        }

        // Calculate total price
        $checkIn = Carbon::parse($validated['check_in_date']);
        $checkOut = Carbon::parse($validated['check_out_date']);
        $nights = $checkOut->diffInDays($checkIn);
        $totalPrice = $room->price * $nights;

        // Create booking
        $booking = Booking::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'guests' => $validated['guests'],
            'total_price' => $totalPrice,
            'status' => 'pending',
            'special_requests' => $validated['special_requests'] ?? null,
            'confirmation_code' => Booking::generateConfirmationCode(),
        ]);

        return response()->json([
            'message' => 'Booking created successfully',
            'data' => $booking->load('room'),
        ], 201);
    }

    /**
     * Get booking details
     */
    public function show(Booking $booking): JsonResponse
    {
        $user = Auth::user();

        if (!$user || ($booking->user_id !== $user->id && !$user->isAdmin())) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        return response()->json([
            'data' => $booking->load(['room', 'payment', 'user']),
        ], 200);
    }

    /**
     * Cancel a booking
     */
    public function cancel(Booking $booking): JsonResponse
    {
        $user = Auth::user();

        if (!$user || ($booking->user_id !== $user->id && !$user->isAdmin())) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        if ($booking->status === 'completed' || $booking->status === 'cancelled') {
            return response()->json([
                'message' => 'Cannot cancel a ' . $booking->status . ' booking',
            ], 422);
        }

        $booking->update(['status' => 'cancelled']);

        return response()->json([
            'message' => 'Booking cancelled successfully',
            'data' => $booking,
        ], 200);
    }

    /**
     * Get booking statistics for dashboard
     */
    public function statistics(): JsonResponse
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'completed_bookings' => Booking::where('status', 'completed')->count(),
            'cancelled_bookings' => Booking::where('status', 'cancelled')->count(),
            'total_revenue' => Booking::where('status', 'completed')->sum('total_price'),
            'average_booking_value' => Booking::avg('total_price'),
            'occupancy_rate' => round((Booking::where('status', 'confirmed')->count() / Room::count()) * 100, 2) . '%',
        ];

        return response()->json([
            'data' => $stats,
        ], 200);
    }
}
