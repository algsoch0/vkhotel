<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms',
            'type' => 'required',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'description' => 'nullable',
            'amenities' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/rooms'), $imageName);
            $data['image'] = 'images/rooms/' . $imageName;
        }

        Room::create($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room->id,
            'type' => 'required',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'description' => 'nullable',
            'amenities' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($room->image && file_exists(public_path($room->image))) {
                unlink(public_path($room->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/rooms'), $imageName);
            $data['image'] = 'images/rooms/' . $imageName;
        }

        $room->update($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully');
    }

    public function destroy(Room $room)
    {
        // Delete image if exists
        if ($room->image && file_exists(public_path($room->image))) {
            unlink(public_path($room->image));
        }
        
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully');
    }
}