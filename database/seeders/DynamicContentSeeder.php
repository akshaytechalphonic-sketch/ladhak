<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DynamicContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Core Pages with SEO Meta
        $home = \App\Models\Page::updateOrCreate(['slug' => 'home'], [
            'page_name' => 'Home',
            'meta_title' => 'HotelRes | Luxury Hotel Booking & Premium Stays',
            'meta_description' => 'Experience world-class luxury at HotelRes. Book your perfect stay today with our seamless booking system.',
            'meta_keywords' => 'luxury hotel, booking, premium stays, hotelres, best hotels',
            'status' => true
        ]);
        
        $about = \App\Models\Page::updateOrCreate(['slug' => 'about-us'], [
            'page_name' => 'About Us',
            'meta_title' => 'Our Story | HotelRes Luxury Hospitality',
            'meta_description' => 'Discover the history, mission, and vision of HotelRes. Redefining luxury hospitality since 2025.',
            'meta_keywords' => 'about hotelres, luxury hospitality, our story, mission, vision',
            'status' => true
        ]);

        // 2. Home Page Sections
        $home->sections()->delete(); // Clear old sections for fresh seed
        $home->sections()->createMany([
            [
                'section_name' => 'hero',
                'title' => 'Where Luxury Meets Comfort',
                'description' => 'Since 2025, HotelRes has been the destination for travelers who seek more than just a place to sleep—they seek an experience.',
                'extra_data' => ['button_text' => 'Find Your Perfect Stay', 'sub_title' => 'Welcome to Excellence'],
                'status' => true
            ],
            [
                'section_name' => 'about_intro',
                'title' => 'Experience the New Standard of Hospitality',
                'description' => 'Our hotels are more than just buildings. They are environments designed to elevate your spirit and provide the ultimate sanctuary from the world.',
                'extra_data' => ['years_experience' => '15+', 'tagline' => 'Premium Hospitality'],
                'status' => true
            ],
            [
                'section_name' => 'why_choose_us',
                'title' => 'Why Travelers Choose Us',
                'description' => 'The HotelRes Advantage',
                'extra_data' => [
                    'features' => [
                        ['title' => 'Best Price', 'icon' => 'bi-currency-dollar'],
                        ['title' => 'Prime Location', 'icon' => 'bi-geo'],
                        ['title' => '24/7 Support', 'icon' => 'bi-headset'],
                        ['title' => 'Clean & Safe', 'icon' => 'bi-shield-check']
                    ]
                ],
                'status' => true
            ],
            [
                'section_name' => 'cta_footer',
                'title' => 'Experience Grandeur Today',
                'description' => 'Book your stay today and experience comfort like never before. Your luxury sanctuary is waiting.',
                'extra_data' => ['button_text' => 'BOOK NOW'],
                'status' => true
            ]
        ]);

        // 3. About Page Sections
        $about->sections()->delete();
        $about->sections()->createMany([
            [
                'section_name' => 'header',
                'title' => 'Our Story',
                'description' => 'Redefining hospitality since 2025.',
                'extra_data' => ['bg_image' => 'thumbs/contact-three-bg.jpg'],
                'status' => true
            ],
            [
                'section_name' => 'main_about',
                'title' => 'Comfort Meets Luxury',
                'description' => 'Welcome to HotelRes, where comfort meets luxury. Located in the heart of the city, we provide a perfect blend of modern amenities and warm hospitality.',
                'extra_data' => ['sub_title' => 'Welcome to Excellence'],
                'status' => true
            ],
            [
                'section_name' => 'mission_vision',
                'title' => 'Our Mission & Vision',
                'extra_data' => [
                    'mission' => 'To provide high-quality hospitality services that ensure comfort, satisfaction, and memorable experiences for every guest.',
                    'vision' => 'To become a trusted and preferred hotel choice known for excellence, service, and customer satisfaction globally.'
                ],
                'status' => true
            ],
            [
                'section_name' => 'stats',
                'extra_data' => [
                    ['value' => '100+', 'label' => 'Happy Guests'],
                    ['value' => '20+', 'label' => 'Luxury Rooms'],
                    ['value' => '15+', 'label' => 'Global Awards'],
                    ['value' => '5+', 'label' => 'Years of Service']
                ],
                'status' => true
            ]
        ]);

        // 4. Dummy Data for Core Modules (3-4 items each)
        \App\Models\Service::truncate();
        \App\Models\Service::createMany([
            ['title' => 'Infinity Pool', 'description' => 'Relax in our world-class infinity pools overlooking the city skyline.', 'icon' => 'bi-water', 'status' => true],
            ['title' => 'Luxury Spa', 'description' => 'Indulge in organic treatments and professional massages.', 'icon' => 'bi-stars', 'status' => true],
            ['title' => 'Fine Dining', 'description' => 'Cuisine prepared by Michelin-starred chefs.', 'icon' => 'bi-cup-hot', 'status' => true],
            ['title' => 'Concierge 24/7', 'description' => 'Personalized assistance for all your travel and leisure needs.', 'icon' => 'bi-headset', 'status' => true],
        ]);

        \App\Models\Offer::truncate();
        \App\Models\Offer::createMany([
            ['title' => 'Weekend Gateway', 'description' => '20% off for all weekend bookings.', 'discount_tag' => '20% OFF', 'status' => true],
            ['title' => 'Honeymoon Special', 'description' => 'Complimentary dinner and spa session.', 'discount_tag' => 'COUPLE', 'status' => true],
            ['title' => 'Summer Escape', 'description' => 'Stay 3 nights, get 1 free during July.', 'discount_tag' => 'FREE NIGHT', 'status' => true],
        ]);

        \App\Models\Destination::truncate();
        \App\Models\Destination::createMany([
            ['title' => 'New York Skyline', 'description' => 'The city that never sleeps.', 'location' => 'New York, USA', 'status' => true],
            ['title' => 'Paris Romance', 'description' => 'Experience the magic of Eiffel.', 'location' => 'Paris, France', 'status' => true],
            ['title' => 'Bali Sanctuary', 'description' => 'Tropical paradise awaits.', 'location' => 'Bali, Indonesia', 'status' => true],
            ['title' => 'Dubai Luxury', 'description' => 'The peak of modern architecture.', 'location' => 'Dubai, UAE', 'status' => true],
        ]);

        \App\Models\Testimonial::truncate();
        \App\Models\Testimonial::createMany([
            ['name' => 'Alice Johnson', 'content' => 'The most incredible stay I\'ve ever had. Truly luxury redefined.', 'rating' => 5, 'role' => 'Business Traveler', 'status' => true],
            ['name' => 'Mark Wilson', 'content' => 'Exceptional service and stunning views. Will definitely return!', 'rating' => 5, 'role' => 'Vacationer', 'status' => true],
            ['name' => 'Sarah Davis', 'content' => 'The fine dining experience was out of this world. Highly recommend!', 'rating' => 5, 'role' => 'Food Critic', 'status' => true],
            ['name' => 'James Miller', 'content' => 'A perfect retreat for our anniversary. The staff went above and beyond.', 'rating' => 5, 'role' => 'Loyal Guest', 'status' => true],
        ]);
        
        if (\App\Models\Room::count() == 0) {
            $hotel = \App\Models\Hotel::first() ?? \App\Models\Hotel::create(['name' => 'HotelRes Grand', 'location' => 'Metropolis', 'description' => 'The flagship hotel.']);
            \App\Models\Room::createMany([
                ['hotel_id' => $hotel->id, 'type' => 'Deluxe Room', 'price' => 250, 'capacity' => 2, 'description' => 'Modern comfort with city views.', 'is_available' => true],
                ['hotel_id' => $hotel->id, 'type' => 'Executive Suite', 'price' => 450, 'capacity' => 3, 'description' => 'Luxury living for the corporate elite.', 'is_available' => true],
                ['hotel_id' => $hotel->id, 'type' => 'Presidential Palace', 'price' => 1200, 'capacity' => 4, 'description' => 'The pinnacle of exclusivity.', 'is_available' => true],
            ]);
        }
    }
}
