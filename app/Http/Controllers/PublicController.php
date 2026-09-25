<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Enquiry;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Service;
use App\Models\Offer;
use App\Models\Testimonial;
use App\Models\Destination;
use App\Models\Gallery;
use App\Models\Package;

class PublicController extends Controller
{
    public function index()
    {
        $featuredHotels = Hotel::withCount('rooms')->latest()->take(6)->get();
        $featuredServices = Service::where('status', true)->latest()->take(4)->get();
        $testimonials = Testimonial::where('status', true)->latest()->take(3)->get();
        $offers = Offer::where('status', true)->latest()->take(2)->get();
        $rooms = Room::where('is_available', true)->with('hotel')->latest()->take(4)->get();
        $destinations = Destination::where('status', true)->latest()->take(8)->get();
        $blogs = Blog::where('is_published', true)->latest()->take(4)->get();
        $featuredPackages = Package::where('status', true)->where('featured', true)->with(['destination', 'service'])->latest()->take(8)->get();

        // Fetch Home Page Sections
        $page = Page::where('slug', 'home')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
        
      

        $galleries = \App\Models\Gallery::where('status', true)->latest()->take(6)->get();

        return view('welcome', compact(
            'featuredHotels',
            'featuredServices',
            'testimonials',
            'offers',
            'rooms',
            'destinations',
            'sections',
            'galleries',
            'page',
            'blogs',
            'featuredPackages'
        ));
    }

    public function hotels(Request $request)
    {
     
        
        $query = Hotel::query();

        if ($request->filled('destination')) {
            $query->where('destination_id', $request->destination);
        }

        $hotels = $query->with('rooms')->latest()->paginate(9);
        $page = Page::where('slug', 'hotel')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
        return view('hotels.index', compact('hotels', 'page', 'sections'));
    }

    public function hotel(Hotel $hotel)
    {

        $page = Page::where('slug', 'hotel')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
        $hotel->load(['rooms' => function ($q) {
            $q->where('is_available', true);
        }]);
       
        return view('hotels.show', compact('hotel', 'sections'));
    }

    public function rooms(Request $request)
    {

        $query = Room::where('is_available', true)->with('hotel');

        if ($request->filled('bed_type')) {
            $query->where('bed_type', $request->bed_type);
        }
        if ($request->filled('view_type')) {
            $query->where('view_type', $request->view_type);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->filled('capacity')) {
            $query->where('capacity', '>=', $request->capacity);
        }

        $rooms = $query->latest()->paginate(9)->appends($request->query());
        $page = Page::where('slug', 'rooms')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
        $bedTypes = Room::where('is_available', true)->whereNotNull('bed_type')->distinct()->pluck('bed_type');
        $viewTypes = Room::where('is_available', true)->whereNotNull('view_type')->distinct()->pluck('view_type');

        return view('rooms.index', compact('rooms', 'page', 'sections', 'bedTypes', 'viewTypes'));
    }

    public function roomShow(Room $room)
    {
        $room->load('hotel');
        $relatedRooms = Room::where('hotel_id', $room->hotel_id)
            ->where('id', '!=', $room->id)
            ->where('is_available', true)
            ->take(3)->get();
        return view('rooms.show', compact('room', 'relatedRooms'));
    }

    public function book(Room $room)
    {
        if (!$room->is_available) {
            return redirect()->back()->with('error', 'This room is currently unavailable.');
        }

        // Resolve rate plan from query string
        $planType = request('plan');
        $selectedPlan = null;
        if ($planType && !empty($room->rate_plans)) {
            foreach ($room->rate_plans as $plan) {
                if (($plan['type'] ?? '') === $planType) {
                    $selectedPlan = $plan;
                    break;
                }
            }
        }

        return view('bookings.create', compact('room', 'selectedPlan'));
    }

    public function storeBooking(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:20',
            'check_in'         => 'required|date|after_or_equal:today',
            'check_out'        => 'required|date|after:check_in',
            'guests'           => 'required|integer|min:1|max:' . $room->capacity,
            'special_requests' => 'nullable|string',
            'rate_plan_name'   => 'nullable|string|max:255',
            'rate_plan_price'  => 'nullable|numeric|min:0',
        ]);

        $checkIn    = \Carbon\Carbon::parse($validated['check_in']);
        $checkOut   = \Carbon\Carbon::parse($validated['check_out']);
        $nights     = $checkIn->diffInDays($checkOut);
        // Use selected plan price if provided, otherwise fall back to base room price
        $pricePerNight = !empty($validated['rate_plan_price']) ? $validated['rate_plan_price'] : $room->price;
        $totalPrice = $nights * $pricePerNight;

        Booking::create([
            'room_id'          => $room->id,
            'name'             => $validated['name'],
            'email'            => $validated['email'],
            'phone'            => $validated['phone'],
            'check_in'         => $validated['check_in'],
            'check_out'        => $validated['check_out'],
            'guests'           => $validated['guests'],
            'special_requests' => $validated['special_requests'],
            'total_price'      => $totalPrice,
            'rate_plan_name'   => $validated['rate_plan_name'] ?? null,
            'rate_plan_price'  => $validated['rate_plan_price'] ?? null,
            'status'           => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Your booking request has been submitted successfully! We will contact you soon.');
    }

    // public function contact()
    // {
    //     $contactdata=Page::with('sections')->where('page_name','contact us')->first();
    //     dd($contactdata);

    //     return view('contact',compact('contactdata'));
    // }

    public function contact()
    {

        $page = Page::where('slug', 'contact-us')->first();
        $sections = $page ? $page->sections->where('status', true)->keyBy('section_name') : collect();
        return view('contact', compact('page', 'sections'));
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Enquiry::create($validated);

        return redirect()->back()->with('success', 'Your message has been sent successfully. We will get back to you shortly.');
    }

    public function blogs()
    {
        $blogs = Blog::where('is_published', true)->latest()->paginate(9);
        $page = Page::where('slug', 'blog')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
        // dd($sections);
        return view('blogs.index', compact('blogs', 'page', 'sections'));
    }

    public function blog($slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $page = Page::where('slug', 'blog-detail')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();

        // Fetch 5 recent blogs excluding current for the sidebar
        $relatedBlogs = Blog::where('is_published', true)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('blogs.show', compact('blog', 'sections', 'relatedBlogs'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page) {
            return view('pages.show', compact('page'));
        }

        // Fallback for hardcoded views if model doesn't exist
        if (view()->exists($slug)) {
            return view($slug);
        }

        abort(404);
    }

    public function about()
    {

        $page = Page::where('slug', 'about-us')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
    
      
        $testimonials = Testimonial::where('status', true)->latest()->take(3)->get();
        $galllery = Gallery::where('status', true)->get();
        return view('about', compact('page', 'sections', 'testimonials', 'galllery'));
    }

    public function services()
    {
        $page = Page::where('slug', 'services')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
        $services = Service::where('status', true)->latest()->get();
        return view('services.index', compact('page', 'sections', 'services'));
    }

    public function serviceDetails($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $packages = Package::where('service_id', $service->id)->where('status', true)->latest()->paginate(8);
        return view('services.show', compact('service', 'packages'));
    }

    public function offers()
    {
        $page = Page::where('slug', 'offers')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
        $offers = Offer::where('status', true)->latest()->get();
        return view('offers', compact('page', 'sections', 'offers'));
    }

    public function gallery()
    {
        $page = Page::where('slug', 'gallery')->first() ?? Page::create(['page_name' => 'Gallery', 'slug' => 'gallery', 'status' => true]);
        $sections = $page->sections()->where('status', true)->get()->keyBy('section_name');
        $galleries = \App\Models\Gallery::where('status', true)->latest()->get();

        // Get all unique categories
        $categories = \App\Models\Gallery::where('status', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->toArray();

        return view('gallery', compact('page', 'sections', 'galleries', 'categories'));
    }

    public function testimonials()
    {
        $page = Page::where('slug', 'testimonial')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();

        $testimonials = Testimonial::where('status', true)->latest()->get();
        return view('testimonials', compact('page', 'sections', 'testimonials'));
    }

    public function destinations()
    {
        $page = Page::where('slug', 'destination')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
       
     
        $destinations = Destination::where('status', true)->latest()->get();
        return view('destinations.index', compact('page', 'sections', 'destinations'));
    }

    public function destinationDetails($slug)
    {
        
        $page = Page::where('slug', 'destination-detial')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
        $destination = Destination::with(['hotels.rooms'])->where('slug',$slug)->first();
        $minprice = $destination->hotels
            ->pluck('rooms')
            ->flatten()
            ->min('price');
           

        $maxprice = $destination->hotels
            ->pluck('rooms')
            ->flatten()
            ->max('price');
       

        return view('destinations.show', compact('destination', 'sections','minprice','maxprice'));
    }

    public function privacyPolicy()
    {
        $page = Page::where('slug', 'privacy-policy')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
       
        return view('privacy-policy', compact('page', 'sections'));
    }

    public function termsConditions()
    {
        $page = Page::where('slug', 'terms-and-conditions')->first();
       
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
        return view('terms-conditions', compact('page', 'sections'));
    }

    public function faq()
    {
        $page = Page::where('slug', 'faq')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();
      
        $faqs = \App\Models\Faq::where('status', true)->orderBy('order')->get();
        return view('faq', compact('page', 'sections', 'faqs'));
    }

    public function packages(Request $request)
    {
        $query = Package::where('status', true)->with(['destination', 'service']);

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }
        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        $packages = $query->latest()->paginate(9)->appends($request->query());
        $destinations = Destination::where('status', true)->get();
        $services = Service::where('status', true)->get();

        $page = Page::where('slug', 'packages')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();

        return view('packages.index', compact('packages', 'destinations', 'services', 'page', 'sections'));
    }

    public function packageShow($slug)
    {
        $package = Package::where('slug', $slug)->where('status', true)->firstOrFail();
        $relatedPackages = Package::where('status', true)
            ->where('id', '!=', $package->id)
            ->where(function($q) use ($package) {
                $q->where('destination_id', $package->destination_id)
                  ->orWhere('service_id', $package->service_id);
            })
            ->take(3)->get();

        $page = Page::where('slug', 'package-detail')->first();
        $sections = $page ? $page->sections()->where('status', true)->get()->keyBy('section_name') : collect();

        return view('packages.show', compact('package', 'relatedPackages', 'page', 'sections'));
    }

    public function storePackageEnquiry(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|max:20',
            'travel_date' => 'required|date|after_or_equal:today',
            'adults'      => 'required|integer|min:1',
            'children'    => 'nullable|integer|min:0',
            'message'     => 'nullable|string',
        ]);

        Enquiry::create([
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'phone'        => $validated['phone'],
            'travel_date'  => $validated['travel_date'],
            'adults'       => $validated['adults'],
            'children'     => $validated['children'] ?? 0,
            'message'      => $validated['message'] ?? 'No message provided.',
            'package_id'   => $package->id,
            'is_responded' => false
        ]);

        return redirect()->back()->with('success', 'Your booking enquiry for ' . $package->title . ' has been submitted successfully! Our tour expert will contact you shortly.');
    }
}
