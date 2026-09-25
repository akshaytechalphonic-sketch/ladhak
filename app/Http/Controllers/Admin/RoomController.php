<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('hotel')->latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('admin.rooms.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id'   => 'required|exists:hotels,id',
            'room_type'  => 'required|string|max:255',
            'price'      => 'required|numeric|min:0',
            'capacity'   => 'required|integer|min:1',
            'size'       => 'nullable|string|max:100',
            'bed_type'   => 'nullable|string|max:100',
            'view_type'  => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'images.*'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('rooms', 'public');
            }
        }
       
        Room::create([
            'hotel_id'    => $request->hotel_id,
            'room_type'   => $request->room_type,
            'slug'        => Room::generateSlug($request->room_type),
            'price'       => $request->price,
            'capacity'    => $request->capacity,
            'is_available' => $request->has('is_available'),
            'size'        => $request->size,
            'bed_type'    => $request->bed_type,
            'view_type'   => $request->view_type,
            'description' => $request->description,
            'images'      => $imagePaths,
            'rate_plans'  => $this->buildRatePlans($request),
            'inclusions'  => $request->inclusions ? array_map('trim', explode(',', $request->inclusions)) : [],
            'exclusions'  => $request->exclusions ? array_map('trim', explode(',', $request->exclusions)) : [],
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        $hotels = Hotel::all();
        return view('admin.rooms.edit', compact('room', 'hotels'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'hotel_id'   => 'required|exists:hotels,id',
            'room_type'  => 'required|string|max:255',
            'price'      => 'required|numeric|min:0',
            'capacity'   => 'required|integer|min:1',
            'size'       => 'nullable|string|max:100',
            'bed_type'   => 'nullable|string|max:100',
            'view_type'  => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'images.*'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);

        $imagePaths = $room->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('rooms', 'public');
            }
        }

        $room->update([
            'hotel_id'    => $request->hotel_id,
            'room_type'   => $request->room_type,
            'slug'        => Room::generateSlug($request->room_type, $room->id),
            'price'       => $request->price,
            'capacity'    => $request->capacity,
            'is_available' => $request->has('is_available'),
            'size'        => $request->size,
            'bed_type'    => $request->bed_type,
            'view_type'   => $request->view_type,
            'description' => $request->description,
            'images'      => $imagePaths,
            'rate_plans'  => $this->buildRatePlans($request),
            'inclusions'  => $request->inclusions ? array_map('trim', explode(',', $request->inclusions)) : [],
            'exclusions'  => $request->exclusions ? array_map('trim', explode(',', $request->exclusions)) : [],
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
    }

    public function removeImage(Request $request, Room $room)
    {
        $imagePath = $request->image_path;
        $images = $room->images ?? [];

        if (($key = array_search($imagePath, $images)) !== false) {
            unset($images[$key]);
            
            // Delete from storage
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($imagePath);
            }

            $room->update(['images' => array_values($images)]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }

    private function buildRatePlans(Request $request): array
    {
        $plans = [];
        $planNames = $request->input('plan_name', []);
        $planPrices = $request->input('plan_price', []);
        $planTypes = $request->input('plan_type', []);
        foreach ($planNames as $i => $name) {
            if (!empty($name)) {
                $plans[] = [
                    'name'  => $name,
                    'price' => $planPrices[$i] ?? '',
                    'type'  => $planTypes[$i] ?? 'flexible',
                ];
            }
        }
        return $plans;
    }
}
