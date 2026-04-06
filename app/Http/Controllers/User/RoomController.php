<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::where('is_available', true);

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by capacity
        if ($request->has('capacity') && $request->capacity != '') {
            $query->where('capacity', '>=', $request->capacity);
        }

        $rooms = $query->latest()->paginate(9);
        $roomTypes = Room::distinct('type')->pluck('type');

        return view('user.rooms.index', compact('rooms', 'roomTypes'));
    }

    public function show(Room $room)
    {
        return view('user.rooms.show', compact('room'));
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