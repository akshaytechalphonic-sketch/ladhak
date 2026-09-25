<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Service;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with(['destination', 'service'])->latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $destinations = Destination::get();
        $services = Service::where('status', true)->get();
        return view('admin.packages.create', compact('destinations', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'duration'       => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'destination_id' => 'nullable|integer',
            'service_id'     => 'nullable|integer',
            'start_location' => 'nullable|string|max:255',
            'difficulty'     => 'nullable|string|max:255',
            'best_season'    => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',
            'images.*'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('packages', 'public');
            }
        }

        $slug = Package::generateSlug($request->title);

        Package::create([
            'destination_id'   => $request->destination_id,
            'service_id'       => $request->service_id,
            'title'            => $request->title,
            'slug'             => $slug,
            'duration'         => $request->duration,
            'price'            => $request->price,
            'start_location'   => $request->start_location,
            'difficulty'       => $request->difficulty,
            'best_season'      => $request->best_season,
            'description'      => $request->description,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'inclusions'       => $request->inclusions ? array_filter(array_map('trim', explode("\n", $request->inclusions))) : [],
            'exclusions'       => $request->exclusions ? array_filter(array_map('trim', explode("\n", $request->exclusions))) : [],
            'itinerary'        => $this->parseItineraryLines($request->itinerary),
            'images'           => $imagePaths,
            'status'           => $request->has('status'),
            'featured'         => $request->has('featured'),
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        $destinations = Destination::get();
        $services = Service::where('status', true)->get();
        return view('admin.packages.edit', compact('package', 'destinations', 'services'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'duration'       => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'destination_id' => 'nullable|integer',
            'service_id'     => 'nullable|integer',
            'start_location' => 'nullable|string|max:255',
            'difficulty'     => 'nullable|string|max:255',
            'best_season'    => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',
            'images.*'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);

        $imagePaths = $package->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('packages', 'public');
            }
        }

        // Only regenerate slug if title changes
        $slug = $package->slug;
        if ($package->title !== $request->title) {
            $slug = Package::generateSlug($request->title);
        }

        $package->update([
            'destination_id'   => $request->destination_id,
            'service_id'       => $request->service_id,
            'title'            => $request->title,
            'slug'             => $slug,
            'duration'         => $request->duration,
            'price'            => $request->price,
            'start_location'   => $request->start_location,
            'difficulty'       => $request->difficulty,
            'best_season'      => $request->best_season,
            'description'      => $request->description,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'inclusions'       => $request->inclusions ? array_filter(array_map('trim', explode("\n", $request->inclusions))) : [],
            'exclusions'       => $request->exclusions ? array_filter(array_map('trim', explode("\n", $request->exclusions))) : [],
            'itinerary'        => $this->parseItineraryLines($request->itinerary),
            'images'           => $imagePaths,
            'status'           => $request->has('status'),
            'featured'         => $request->has('featured'),
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function removeImage(Request $request, Package $package)
    {
        $imagePath = $request->image_path;
        $images = $package->images ?? [];

        if (($key = array_search($imagePath, $images)) !== false) {
            unset($images[$key]);

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $package->update(['images' => array_values($images)]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
    }

    public function destroy(Package $package)
    {
        if (!empty($package->images)) {
            foreach ($package->images as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }

    private function parseItineraryLines($text): array
    {
        if (!$text) return [];
        // Replace \r\n with \n first
        $text = str_replace("\r\n", "\n", $text);
        $lines = array_filter(array_map('trim', explode("\n", $text)));
        $result = [];
        foreach ($lines as $line) {
            $parts = explode('|', $line);
            $result[] = [
                'day' => trim($parts[0] ?? ''),
                'title' => trim($parts[1] ?? ''),
                'description' => trim($parts[2] ?? '')
            ];
        }
        return $result;
    }
}
