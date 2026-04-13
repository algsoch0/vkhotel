<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookings()->with('room')->latest()->paginate(10);
        return view('user.bookings.index', compact('bookings'));
    }

    public function create(Request $request, Room $room)
    {
        if (!$request->filled(['check_in', 'check_out', 'guests'])) {
            return view('user.bookings.create', [
                'room' => $room,
                'bookingData' => [
                    'check_in' => now()->addDay()->toDateString(),
                    'check_out' => now()->addDays(2)->toDateString(),
                    'guests' => 1,
                ],
                'totalPrice' => $room->price,
                'nights' => 1,
            ]);
        }

        $validated = $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $room->capacity
        ]);

        $nights = now()->parse($validated['check_in'])->diffInDays(now()->parse($validated['check_out']));
        $totalPrice = $room->price * $nights;

        return view('user.bookings.create', [
            'room' => $room,
            'bookingData' => $validated,
            'totalPrice' => $totalPrice,
            'nights' => $nights,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string|max:1200'
        ]);

        $room = Room::findOrFail($request->room_id);

        if ((int) $request->guests > (int) $room->capacity) {
            return back()->withInput()->with('error', 'Guest count exceeds room capacity.');
        }
        
        // Check availability again
        $isAvailable = !$room->bookings()
            ->where('check_in_date', '<', $request->check_out_date)
            ->where('check_out_date', '>', $request->check_in_date)
            ->whereIn('status', ['confirmed', 'pending'])
            ->exists();

        if (!$isAvailable) {
            return back()->withInput()->with('error', 'Room is not available for the selected dates.');
        }

        $nights = now()->parse($request->check_in_date)->diffInDays(now()->parse($request->check_out_date));
        $totalPrice = $room->price * $nights;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guests' => $request->guests,
            'total_price' => $totalPrice,
            'special_requests' => $request->special_requests,
            'status' => 'pending',
            'confirmation_code' => 'VK-' . Str::upper(Str::random(10)),
        ]);

        return redirect()->route('user.bookings.show', $booking)
            ->with('success', 'Booking created successfully');
    }

    public function show(Booking $booking)
    {
        // Check if booking belongs to authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status === 'pending' || $booking->status === 'confirmed') {
            $booking->update(['status' => 'cancelled']);
            return back()->with('success', 'Booking cancelled successfully');
        }

        return back()->with('error', 'Booking cannot be cancelled');
    }
}