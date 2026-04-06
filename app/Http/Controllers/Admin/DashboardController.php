<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalRooms = Room::count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $recentBookings = Booking::with(['user', 'room'])->latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalUsers', 'totalRooms', 'totalBookings', 
            'pendingBookings', 'recentBookings', 'recentContacts'
        ));
    }
}