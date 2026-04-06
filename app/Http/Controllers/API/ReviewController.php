<?php

namespace App\Http\Controllers\API;

use App\Models\Room;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController
{
    /**
     * Get reviews for a room
     */
    public function index(Room $room, Request $request): JsonResponse
    {
        $reviews = $room->reviews()
            ->where('is_verified', true)
            ->orderByDesc('rating')
            ->paginate((int) $request->input('per_page', 10));

        return response()->json($reviews, 200);
    }

    /**
     * Create a new review
     */
    public function store(Room $room, Request $request): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:100',
            'comment' => 'required|string|max:1000',
        ]);

        // Check if user has already reviewed this room
        $existingReview = Review::where('user_id', $user->id)
            ->where('room_id', $room->id)
            ->exists();

        if ($existingReview) {
            return response()->json([
                'message' => 'You have already reviewed this room',
            ], 422);
        }

        $review = Review::create([
            'room_id' => $room->id,
            'user_id' => $user->id,
            'booking_id' => $validated['booking_id'],
            'rating' => $validated['rating'],
            'title' => $validated['title'],
            'comment' => $validated['comment'],
            'is_verified' => true,
        ]);

        return response()->json([
            'message' => 'Review submitted successfully',
            'data' => $review,
        ], 201);
    }

    /**
     * Get reviews statistics
     */
    public function statistics(Room $room): JsonResponse
    {
        $reviews = $room->reviews()->where('is_verified', true)->get();

        $stats = [
            'total_reviews' => $reviews->count(),
            'average_rating' => $reviews->avg('rating') ?? 0,
            'rating_distribution' => [
                '5' => $reviews->where('rating', 5)->count(),
                '4' => $reviews->where('rating', 4)->count(),
                '3' => $reviews->where('rating', 3)->count(),
                '2' => $reviews->where('rating', 2)->count(),
                '1' => $reviews->where('rating', 1)->count(),
            ],
        ];

        return response()->json([
            'data' => $stats,
        ], 200);
    }
}
