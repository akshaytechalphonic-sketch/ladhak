<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Offer;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\Package;
use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LadakhDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Clean old data (truncate tables)
        // Disable foreign key checks for clean truncation
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        
        Package::truncate();
        Room::truncate();
        Hotel::truncate();
        Destination::truncate();
        Service::truncate();
        Offer::truncate();
        Testimonial::truncate();
        Blog::truncate();
        Faq::truncate();
        Page::truncate();
        
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // 2. Create Users
        $admin = User::updateOrCreate([
            'email' => 'admin@hotelres.com',
        ], [
            'name' => 'Ladakh Tourism Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::updateOrCreate([
            'email' => 'customer@example.com',
        ], [
            'name' => 'Tashi Namgyal',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // 3. Create Core Pages with Premium SEO Meta
        $home = Page::create([
            'slug' => 'home',
            'page_name' => 'Home',
            'meta_title' => 'Premium Ladakh Tour Packages & Luxury Hotels | Ladakh Tourism',
            'meta_description' => 'Book premium Leh Ladakh tour packages, bike trips, trekking tours, and luxury hotels. Discover the land of high passes with our local travel experts.',
            'meta_keywords' => 'ladakh tourism, leh ladakh tour, ladakh bike tour, leh hotels, pangong lake camp, ladakh travel agency',
            'status' => true
        ]);
        
        $about = Page::create([
            'slug' => 'about-us',
            'page_name' => 'About Us',
            'meta_title' => 'About Us | Ladakh Tourism & Premium Travel Organizers',
            'meta_description' => 'Learn about Ladakh Tourism, the premier local tour operator organizing custom bike tours, cultural safaris, and luxury stays across Ladakh.',
            'meta_keywords' => 'about ladakh tourism, local tour operator leh, travel agency ladakh, tashi namgyal tour planner',
            'status' => true
        ]);

        Page::create([
            'slug' => 'packages',
            'page_name' => 'Tour Packages',
            'meta_title' => 'Explore Premium Ladakh Tour Packages & Custom Itineraries',
            'meta_description' => 'Browse our curated Ladakh packages: bike expeditions, family packages, trekking, and sightseeing itineraries.',
            'meta_keywords' => 'ladakh packages, leh tour package, bike trip khardungla, zanskar valley trek',
            'status' => true
        ]);

        Page::create([
            'slug' => 'package-detail',
            'page_name' => 'Package Details',
            'meta_title' => 'Tour Details & Itinerary | Ladakh Tourism',
            'meta_description' => 'Detailed day-by-day travel itinerary, inclusions, exclusions, and booking information for our premium Ladakh packages.',
            'meta_keywords' => 'ladakh tour itinerary, package inclusions, custom travel plan',
            'status' => true
        ]);

        Page::create([
            'slug' => 'contact-us',
            'page_name' => 'Contact Us',
            'meta_title' => 'Contact Ladakh Tourism | Plan Your Ladakh Holiday',
            'meta_description' => 'Get in touch with our Ladakh travel experts. Contact us for custom tour plans, taxi bookings, permits, or hotel enquiries.',
            'meta_keywords' => 'contact ladakh tourism, leh travel office phone, email leh tour planner',
            'status' => true
        ]);

        // 4. Create Page Sections (Home)
        $home->sections()->createMany([
            [
                'section_name' => 'hero',
                'title' => 'Experience the Majestic Land of High Passes',
                'description' => 'Curated premium tour packages, luxury hotels, and adventure bike expeditions across Leh, Pangong Lake, and Nubra Valley.',
                'extra_data' => [
                    'button_text' => 'Explore Packages', 
                    'sub_title' => 'Welcome to Premium Ladakh Tourism',
                    'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4'
                ],
                'status' => true
            ],
            [
                'section_name' => 'about_intro',
                'title' => 'Your Trusted Gateway to the Himalayas',
                'description' => 'We are local pioneers in organizing luxury travel and high-adrenaline expeditions in Ladakh. From customized Royal Enfield bike tours to premium boutique resort stays, we handle every detail with absolute precision so you can immerse yourself in the majestic beauty of the mountains.',
                'extra_data' => ['years_experience' => '12+', 'tagline' => '100% Local Hospitality'],
                'status' => true
            ],
            [
                'section_name' => 'why_choose_us',
                'title' => 'Why Travelers Choose Ladakh Tourism',
                'description' => 'Crafting unforgettable Himalayan journeys with safety, comfort, and premium style.',
                'extra_data' => [
                    'features' => [
                        ['title' => 'Local Experts', 'icon' => 'bi-geo-alt', 'desc' => 'Native guides with deep knowledge of terrain, culture, and safety.'],
                        ['title' => 'Premium Stays', 'icon' => 'bi-buildings', 'desc' => 'Carefully vetted handpicked luxury hotels and premium camps.'],
                        ['title' => 'Safety First', 'icon' => 'bi-shield-check', 'desc' => 'Oxygen backups, 24/7 support, and seasoned backup teams.'],
                        ['title' => 'Bespoke Travel', 'icon' => 'bi-sliders', 'desc' => '100% customized tour itineraries matching your pace and preferences.']
                    ]
                ],
                'status' => true
            ],
            [
                'section_name' => 'cta_footer',
                'title' => 'Are You Ready for the Ultimate Adventure?',
                'description' => 'Get in touch today to customize your dream Ladakh itinerary with our local tour experts.',
                'extra_data' => ['button_text' => 'GET A CUSTOM QUOTE'],
                'status' => true
            ]
        ]);

        // 5. Create Page Sections (About Us)
        $about->sections()->createMany([
            [
                'section_name' => 'header',
                'title' => 'Our Journey',
                'description' => 'Leading local tour operator in Ladakh dedicated to sustainable tourism and premium hospitality.',
                'extra_data' => ['bg_image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1920'],
                'status' => true
            ],
            [
                'section_name' => 'main_about',
                'title' => 'Pioneering Luxury Himalayan Hospitality',
                'description' => 'Ladakh Tourism was founded with the passion of sharing our homeland\'s raw beauty, ancient Buddhist heritage, and thrill of adventure with the world. Over the last 12 years, we have designed customized tours that seamlessly blend raw Himalayan nature with premium comfort, gourmet local cuisine, and absolute safety.',
                'extra_data' => ['sub_title' => 'Elevating Mountain Stays'],
                'status' => true
            ],
            [
                'section_name' => 'mission_vision',
                'title' => 'Our Core Values',
                'extra_data' => [
                    'mission' => 'To offer authentic, secure, and luxury-tier travel experiences that respect and sustain the local culture and ecosystem of Ladakh.',
                    'vision' => 'To remain the most trusted local brand in premium Himalayan travel, recognized for unparalleled service, hospitality, and ecological responsibility.'
                ],
                'status' => true
            ],
            [
                'section_name' => 'stats',
                'extra_data' => [
                    ['value' => '5,000+', 'label' => 'Happy Travelers'],
                    ['value' => '15+', 'label' => 'Custom Routes'],
                    ['value' => '80+', 'label' => 'Oxygenated Vehicles'],
                    ['value' => '12+', 'label' => 'Years of Excellence']
                ],
                'status' => true
            ]
        ]);

        // 6. Seed Destinations
        $d1 = Destination::create([
            'name' => 'Leh District',
            'slug' => Destination::generateSlug('Leh District'),
            'description' => 'The vibrant heart of Ladakh. Home to royal palaces, historical monasteries, and beautiful markets.',
            'location' => 'Leh, Ladakh',
            'image' => null,
            'status' => true
        ]);

        $d2 = Destination::create([
            'name' => 'Nubra Valley',
            'slug' => Destination::generateSlug('Nubra Valley'),
            'description' => 'Famous for the cold desert sand dunes of Hunder, double-humped Bactrian camels, and Diskit Monastery.',
            'location' => 'Nubra, Ladakh',
            'image' => null,
            'status' => true
        ]);

        $d3 = Destination::create([
            'name' => 'Pangong Tso Lake',
            'slug' => Destination::generateSlug('Pangong Tso Lake'),
            'description' => 'The majestic endorheic lake situated at 4,250m that changes color from deep turquoise to azure blue.',
            'location' => 'Changthang, Ladakh',
            'image' => null,
            'status' => true
        ]);

        $d4 = Destination::create([
            'name' => 'Zanskar Valley',
            'slug' => Destination::generateSlug('Zanskar Valley'),
            'description' => 'The most remote and rugged destination, ideal for hardcore trekking, Phugtal Monastery, and pristine white-water rafting.',
            'location' => 'Kargil District, Ladakh',
            'image' => null,
            'status' => true
        ]);

        // 7. Seed Services
        $s1 = Service::create([
            'title' => 'Premium Bike Rentals',
            'description' => 'Ride high-performance Royal Enfield Himalayan 450s, professionally serviced and equipped for rugged terrains.',
            'icon' => 'bi-bicycle',
            'status' => true
        ]);

        $s2 = Service::create([
            'title' => 'Bespoke Tour Itineraries',
            'description' => '100% customizable Ladakh packages matching your pace, group size, and interests.',
            'icon' => 'bi-compass',
            'status' => true
        ]);

        $s3 = Service::create([
            'title' => 'Luxury Stays & Camps',
            'description' => 'Enjoy cozy glamping at Pangong and Nubra with premium central heating, ensuite bathrooms, and local organic meals.',
            'icon' => 'bi-house-heart',
            'status' => true
        ]);

        $s4 = Service::create([
            'title' => 'Private Oxygenated Transport',
            'description' => 'Chauffeur-driven luxury Innovas and Tempo Travelers equipped with oxygen cylinder backup for high altitude safety.',
            'icon' => 'bi-truck',
            'status' => true
        ]);

        // 8. Seed Offers
        Offer::create([
            'title' => 'Early Bird Ladakh Expedition',
            'description' => 'Book your summer 2026 Ladakh tour package today and get a flat 15% discount on early registrations.',
            'discount_tag' => '15% OFF',
            'status' => true
        ]);

        Offer::create([
            'title' => 'Free Bike Upgrade',
            'description' => 'Book a Ladakh Group Bike Expedition and get upgraded to the latest Himalayan 450 model for free.',
            'discount_tag' => 'UPGRADE',
            'status' => true
        ]);

        Offer::create([
            'title' => 'Family Package Perks',
            'description' => 'Complimentary campfire dining, cultural show, and double sharing premium camp upgrade for family bookings.',
            'discount_tag' => 'CAMP PERK',
            'status' => true
        ]);

        // 9. Seed Hotels
        $h1 = Hotel::create([
            'name' => 'The Grand Dragon Ladakh',
            'slug' => Hotel::generateSlug('The Grand Dragon Ladakh'),
            'destination_id' => $d1->id,
            'star_rating' => 5,
            'managed_by' => 'Grand Dragon Hospitality',
            'usps' => ['Central Heating', 'Monastery Views', 'Eco-friendly Solar Powered', 'Multi-cuisine Dining'],
            'description' => 'The premier luxury hotel in Leh. Combining traditional Ladakhi architecture with five-star modern comforts, offering panoramic views of the Stok Kangri mountain range.',
            'amenities' => ['High Speed Wifi', 'Central Heating', 'Fitness Center', 'Travel Desk', 'Organic Garden Coffee Shop'],
            'landmarks' => [
                ['name' => 'Leh Palace', 'distance' => '1.5 km'],
                ['name' => 'Shanti Stupa', 'distance' => '2.5 km']
            ],
            'airports' => [
                ['name' => 'Leh Kushok Bakula Rimpochee Airport', 'distance' => '3.5 km']
            ],
            'attractions' => [
                ['name' => 'Main Bazaar Leh', 'distance' => '1.0 km']
            ],
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3305.6178308892437!2d77.581896!3d34.159494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38fdeb3714dfb0ad%3A0xe5a3f3b90558ec46!2sThe%20Grand%20Dragon%20Ladakh!5e0!3m2!1sen!2sin!4v1700000000000',
            'images' => []
        ]);

        $h2 = Hotel::create([
            'name' => 'Hunder Sands Luxury Camp',
            'slug' => Hotel::generateSlug('Hunder Sands Luxury Camp'),
            'destination_id' => $d2->id,
            'star_rating' => 4,
            'managed_by' => 'Ladakh Tourism Camps',
            'usps' => ['Ensuite Heated Bathrooms', 'Campfire & Live Music', 'Starlit Glamping Dome', 'Organic Farm Dining'],
            'description' => 'Located near the famous Hunder Sand Dunes, this premium glamping site provides luxury swiss tents with private decks, heating blankets, and outstanding Karakoram range views.',
            'amenities' => ['Wifi at Lounge', 'Ensuite Bathroom', 'Heated Beds', 'Parking', 'Campfire Area'],
            'landmarks' => [
                ['name' => 'Diskit Monastery', 'distance' => '7.0 km'],
                ['name' => 'Hunder Sand Dunes', 'distance' => '0.5 km']
            ],
            'airports' => [
                ['name' => 'Leh Airport', 'distance' => '125 km']
            ],
            'attractions' => [
                ['name' => 'Bactrian Camel Ride Site', 'distance' => '0.6 km']
            ],
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3283.4735282928373!2d77.271896!3d34.582811!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38fc455abc123456%3A0xabcdef1234567890!2sHunder%20Sands!5e0!3m2!1sen!2sin!4v1700000000000',
            'images' => []
        ]);

        // 10. Seed Rooms
        Room::create([
            'hotel_id' => $h1->id,
            'room_type' => 'Deluxe Stok View Room',
            'price' => 9500.00,
            'capacity' => 2,
            'is_available' => true,
            'images' => [],
            'description' => 'Spacious heated bedroom with double bed, floor-to-ceiling windows showing the majestic Stok Kangri range.'
        ]);

        Room::create([
            'hotel_id' => $h1->id,
            'room_type' => 'Heritage Suite',
            'price' => 17500.00,
            'capacity' => 3,
            'is_available' => true,
            'images' => [],
            'description' => 'Boutique suite decorated with traditional Ladakhi wood carvings, featuring a separate private lounge and modern premium amenities.'
        ]);

        Room::create([
            'hotel_id' => $h2->id,
            'room_type' => 'Premium Swiss Luxury Tent',
            'price' => 6800.00,
            'capacity' => 2,
            'is_available' => true,
            'images' => [],
            'description' => 'Double sharing luxury waterproof tent with wooden flooring, premium bed warmers, private veranda, and attached bath.'
        ]);

        // 11. Seed Packages
        $p1 = Package::create([
            'destination_id' => $d1->id,
            'service_id' => $s1->id,
            'title' => 'Ladakh Bike Expedition: Leh, Nubra & Pangong',
            'slug' => 'ladakh-bike-expedition-leh-nubra-pangong',
            'duration' => '7 Days / 6 Nights',
            'price' => 24999.00,
            'start_location' => 'Leh',
            'difficulty' => 'Moderate',
            'best_season' => 'June to September',
            'description' => 'Hop on the latest Royal Enfield Himalayan and conquer the highest motorable passes in the world! Cruise through the dramatic landscapes of Khardung La and Chang La, explore the cold deserts of Nubra, and camp on the shores of the breathtaking blue Pangong Lake. Complete with a backup vehicle, mechanic, and oxygen support.',
            'inclusions' => [
                'Royal Enfield Himalayan 450 bike with fuel',
                'Accommodation on twin-sharing basis',
                'Breakfast and dinner daily',
                'Inner Line Permits and wildlife fees',
                'Road Captain, mechanic, and backup vehicle',
                'Oxygen cylinder and basic medical kit'
            ],
            'exclusions' => [
                'Personal expenses and tips',
                'Renting riding gear (available on spot)',
                'Airfare to Leh',
                'Lunch during transit'
            ],
            'itinerary' => [
                ['day' => 'Day 1', 'title' => 'Arrival in Leh & Acclimatization', 'description' => 'Arrive at Leh Airport. Transfer to your luxury hotel. Rest completely to acclimatize to high altitude (3,500m). Meet the Road Captain and test ride bikes in the evening.'],
                ['day' => 'Day 2', 'title' => 'Leh to Nubra Valley via Khardung La', 'description' => 'Drive through the iconic Khardung La Pass (5,359m), the world\'s highest motorable pass. Descent into Nubra Valley and check into your luxury sands camp. Enjoy camel riding at Hunder.'],
                ['day' => 'Day 3', 'title' => 'Nubra to Pangong Tso via Shyok Route', 'description' => 'Ride along the fast-flowing Shyok River through rugged mountain terrain. Reach Pangong Lake (4,250m) and experience the magical evening colours of the lake. Cozy camp stay.'],
                ['day' => 'Day 4', 'title' => 'Pangong to Leh via Chang La Pass', 'description' => 'Wake up early for stunning photography. Ride back to Leh crossing the mighty Chang La Pass (5,360m). Evening shopping at Leh Main Bazaar.'],
                ['day' => 'Day 5', 'title' => 'Leh Sightseeing: Monasteries & Magnetic Hill', 'description' => 'Explore the historical Alchi, Likir and Hemis Monasteries. Experience the optical illusion of Magnetic Hill and view the Indus-Zanskar confluence.'],
                ['day' => 'Day 6', 'title' => 'Departure from Leh', 'description' => 'Transfer to Leh Airport with unforgettable memories of your Himalayan adventure. Bid farewell to the mountains.']
            ],
            'images' => [],
            'status' => true,
            'featured' => true
        ]);

        $p2 = Package::create([
            'destination_id' => $d3->id,
            'service_id' => $s2->id,
            'title' => 'Ultimate Ladakh Explorer (Family Custom Tour)',
            'slug' => 'ultimate-ladakh-explorer-family-custom-tour',
            'duration' => '6 Days / 5 Nights',
            'price' => 19500.00,
            'start_location' => 'Leh',
            'difficulty' => 'Easy',
            'best_season' => 'May to October',
            'description' => 'Designed specifically for families and leisure travelers. Experience the highlight destinations of Ladakh in a private chauffeur-driven SUV. Includes top-rated hotels, child-friendly schedules, acclimatization cushions, and rich cultural interactions including visits to historical palaces and monasteries.',
            'inclusions' => [
                'Private Innova / SUV transportation for all days',
                'Stay at premium 4/5 star hotels and luxury camps',
                'Double sharing accommodation',
                'Breakfast and dinner daily',
                'Inner Line Permits and entry tickets',
                'English speaking local guide'
            ],
            'exclusions' => [
                'Lunches and snacks',
                'Tips for driver and guide',
                'Camel rides and adventure activity charges'
            ],
            'itinerary' => [
                ['day' => 'Day 1', 'title' => 'Arrival in Leh Airport', 'description' => 'Welcome and airport transfer. Spend the day resting. Short evening walk in local market.'],
                ['day' => 'Day 2', 'title' => 'Leh Palace and Shanti Stupa Sightseeing', 'description' => 'Visit the iconic 17th-century Leh Palace, Shanti Stupa for sunset views, and local Buddhist shrines.'],
                ['day' => 'Day 3', 'title' => 'Leh to Nubra Valley (Hunder sand dunes)', 'description' => 'Cross Khardung La in your private vehicle. Check in to Hunder luxury camps, experience Bactrian camel rides.'],
                ['day' => 'Day 4', 'title' => 'Nubra Valley to Pangong Tso Lake', 'description' => 'Drive to Pangong. Enjoy lakeside photography, bonfire dinner, and stargazing in the clear Himalayan skies.'],
                ['day' => 'Day 5', 'title' => 'Pangong to Leh via Thiksey Monastery', 'description' => 'Return to Leh via Chang La. Stop at the spectacular multi-tiered Thiksey Monastery.'],
                ['day' => 'Day 6', 'title' => 'Departure from Leh', 'description' => 'Drop at Leh airport. Tour concludes.']
            ],
            'images' => [],
            'status' => true,
            'featured' => true
        ]);

        // 12. Seed Testimonials
        Testimonial::create([
            'name' => 'Vikram Rathore',
            'content' => 'The Ladakh bike trip organized by Ladakh Tourism was absolutely flawless. The Himalayan bikes were in brand new condition, and our captain was extremely knowledgeable about the mountain roads. Staying at Pangong Camp was the highlight of our trip!',
            'rating' => 5,
            'role' => 'Avid Biker, Delhi',
            'status' => true
        ]);

        Testimonial::create([
            'name' => 'Sarah Campbell',
            'content' => 'We booked the family custom tour. My parents were initially worried about altitude sickness, but the tour planner provided oxygen cylinders and planned the itinerary so well that we had no issues at all. The Grand Dragon hotel was spectacular.',
            'rating' => 5,
            'role' => 'Tourist, UK',
            'status' => true
        ]);

        Testimonial::create([
            'name' => 'Ananya Sen',
            'content' => 'Outstanding hospitality! The local guides knew all the best photography spots. The tents at Hunder Sands were incredibly cozy and warm even when temperature dropped to zero.',
            'rating' => 5,
            'role' => 'Travel Blogger, Kolkata',
            'status' => true
        ]);

        // 13. Seed FAQs
        Faq::create([
            'question' => 'How do I handle altitude sickness in Ladakh?',
            'answer' => 'To acclimatize properly, we strongly advise resting completely for the first 24-36 hours upon arrival in Leh (3,500m). Avoid physical exertion, drink plenty of water, and keep oxygen levels checked. We provide oxygen backup in all our tour vehicles.',
            'order' => 1,
            'status' => true
        ]);

        Faq::create([
            'question' => 'Do I need permits to visit Pangong and Nubra?',
            'answer' => 'Yes, all domestic and international tourists require an Inner Line Permit (ILP) to visit restricted areas like Nubra Valley, Pangong Lake, and Tso Moriri. When you book a package with us, we arrange all your permits beforehand.',
            'order' => 2,
            'status' => true
        ]);

        Faq::create([
            'question' => 'Which mobile networks work in Ladakh?',
            'answer' => 'Only postpaid mobile connections work in Ladakh. BSNL, Airtel, and Jio have the best network coverage in Leh. Nubra and Pangong have limited Jio/Airtel networks. Camp sites usually provide satellite WiFi in designated hours.',
            'order' => 3,
            'status' => true
        ]);

        // 14. Seed Blogs
        Blog::create([
            'user_id' => $admin->id,
            'title' => 'Ladakh Travel Guide: How to Acclimatize and Avoid Altitude Sickness',
            'slug' => 'ladakh-travel-guide-acclimatize-altitude-sickness',
            'content' => 'Traveling to Ladakh is a dream for many, but the high altitude can pose health challenges if proper precautions are not taken. Leh lies at 11,500 feet, and passes like Khardungla cross 17,500 feet. In this article, we outline a day-by-day acclimatization plan, recommended diet, hydration rules, and medical checks to ensure your mountain trip remains completely safe and enjoyable.',
            'is_published' => true
        ]);

        Blog::create([
            'user_id' => $admin->id,
            'title' => 'Top 5 Motorcycling Routes in Ladakh for the Adventure of a Lifetime',
            'slug' => 'top-5-motorcycling-routes-ladakh-adventure',
            'content' => 'For motorcycle enthusiasts, riding in Ladakh is the ultimate pilgrimage. The stretch from Leh to Nubra Valley, riding along the Shyok River to Pangong Lake, and cruising the historic Leh-Manali highway are some of the most scenic and thrilling routes. Learn about the road conditions, bike preparation, safety checkpoints, and best season to plan your expedition.',
            'is_published' => true
        ]);
    }
}
