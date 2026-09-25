<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('destination')->latest()->paginate(10);
    
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $destinations = Destination::get();
        return view('admin.hotels.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required|string|max:255',
            'destination_id' => 'required|integer',
            'location'       => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'amenities'      => 'nullable|string',
            'star_rating'    => 'nullable|integer|min:1|max:5',
            'managed_by'     => 'nullable|string|max:255',
            'usps'           => 'nullable|string',
            'map_embed_url'  => 'nullable|string',
            'images.*'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('hotels', 'public');
            }
        }

        $mapUrl = null;

        if (!empty($request->map_embed_url)) {
            $input = trim($request->map_embed_url);

            // Case 1: Full iframe pasted
            if (str_contains($input, '<iframe')) {
                preg_match('/src="([^"]+)"/', $input, $matches);
                $mapUrl = $matches[1] ?? null;
            } else {
                $mapUrl = $input;
            }

            // ❌ Reject invalid links (like goo.gl or normal maps URL)
            if ($mapUrl && !str_contains($mapUrl, '/maps/embed')) {
                return back()->withInput()->with('error', 'Please enter a valid Google Maps embed URL (use "Embed a map" option).');
            }
        }

        // ✅ Upload images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('hotels', 'public');
            }
        }

        $slug = Hotel::generateSlug($request->name);
    
        Hotel::create([
            'name'        => $validated['name'],
            'destination_id' => $request->destination_id,
            'slug'        => $slug,
            'location'    => $validated['location'],
            'description' => $validated['description'],
            'amenities'   => $request->amenities ? array_map('trim', explode(',', $request->amenities)) : [],
            'images'      => $imagePaths,
            'star_rating' => $request->star_rating ?? 5,
            'managed_by'  => $request->managed_by,
            'usps'        => $request->usps ? array_map('trim', explode(',', $request->usps)) : [],
            'map_embed_url' => $mapUrl,
            'landmarks'   => $this->parseKeyValueLines($request->landmarks),
            'airports'    => $this->parseKeyValueLines($request->airports),
            'attractions' => $this->parseKeyValueLines($request->attractions),
        ]);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully.');
    }

    public function edit(Hotel $hotel)
    {
        $destinations = Destination::get();

        return view('admin.hotels.edit', compact('hotel', 'destinations'));
    }

    public function update(Request $request, Hotel $hotel)
    {

        $validator = Validator::make($request->all(), [
            'name'           => 'required|string|max:255',
            'destination_id' => 'required|integer',
            'location'       => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'amenities'      => 'nullable|string',
            'star_rating'    => 'nullable|integer|min:1|max:5',
            'managed_by'     => 'nullable|string|max:255',
            'usps'           => 'nullable|string',
            'map_embed_url'  => 'nullable|string',
            'images.*'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $imagePaths = $hotel->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('hotels', 'public');
            }
        }

        $mapUrl = null;

        if (!empty($request->map_embed_url)) {
            $input = trim($request->map_embed_url);

            // Case 1: Full iframe pasted
            if (str_contains($input, '<iframe')) {
                preg_match('/src="([^"]+)"/', $input, $matches);
                $mapUrl = $matches[1] ?? null;
            } else {
                $mapUrl = $input;
            }

            // ❌ Reject invalid links (like goo.gl or normal maps URL)
            if ($mapUrl && !str_contains($mapUrl, '/maps/embed')) {
                return back()->withInput()->with('error', 'Please enter a valid Google Maps embed URL (use "Embed a map" option).');
            }
        }

        $slug = Hotel::generateSlug($request->name);
        
        $check = $hotel->update([
            'name'        => $request->name,
            'slug'        => $slug,
            'destination_id' => $request->destination_id,
            'location'    => $request->location,
            'description' => $request->description,
            'amenities'   => $request->amenities ? array_map('trim', explode(',', $request->amenities)) : [],
            'images'      => $imagePaths,
            'star_rating' => $request->star_rating ?? 5,
            'managed_by'  => $request->managed_by,
            'usps'        => $request->usps ? array_map('trim', explode(',', $request->usps)) : [],
            'map_embed_url' => $mapUrl,
            'landmarks'   => $this->parseKeyValueLines($request->landmarks),
            'airports'    => $this->parseKeyValueLines($request->airports),
            'attractions' => $this->parseKeyValueLines($request->attractions),
        ]);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function removeImage(Request $request, Hotel $hotel)
    {
        $imagePath = $request->image_path;
        $images = $hotel->images ?? [];

        if (($key = array_search($imagePath, $images)) !== false) {
            unset($images[$key]);

            // Delete from storage
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $hotel->update(['images' => array_values($images)]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully.');
    }

    // Helper: parse "Name|Distance" per line into array
    private function parseKeyValueLines($text): array
    {
        if (!$text) return [];
        $lines = array_filter(array_map('trim', explode("\n", $text)));
        $result = [];
        foreach ($lines as $line) {
            $parts = explode('|', $line);
            $result[] = ['name' => trim($parts[0] ?? ''), 'distance' => trim($parts[1] ?? '')];
        }
        return $result;
    }
}
