<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Event;
use App\Models\TravelPackage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Destinations
        Destination::create([
            'name' => 'Nusara Island',
            'slug' => 'nusara-island',
            'category' => 'Nature',
            'location' => 'South Halmahera',
            'latitude' => -0.85000000,
            'longitude' => 127.32000000,
            'description' => 'A stunning aerial view of Nusara Island in South Halmahera, showing vibrant coral reefs visible through translucent turquoise waters.',
            'short_description' => 'A stunning aerial view of Nusara Island in South Halmahera.',
            'rating' => 4.9,
            'review_count' => 120,
            'price' => 0,
            'is_featured' => true
        ]);

        Destination::create([
            'name' => 'Bernaveld Fort',
            'slug' => 'bernaveld-fort',
            'category' => 'Historical',
            'location' => 'Labuha City',
            'latitude' => -0.63050000,
            'longitude' => 127.48150000,
            'description' => 'The majestic panoramic view of the Labuha coastline in South Halmahera, showcasing the historical Bernaveld Fort against a backdrop of rolling green hills.',
            'short_description' => 'The majestic panoramic view of the Labuha coastline in South Halmahera.',
            'rating' => 4.7,
            'review_count' => 85,
            'price' => 10000,
            'is_featured' => true
        ]);

        Destination::create([
            'name' => 'Guraici Archipelago',
            'slug' => 'guraici-archipelago',
            'category' => 'Diving',
            'location' => 'Bacan District',
            'latitude' => -0.05000000,
            'longitude' => 127.15000000,
            'description' => 'A close-up high-definition shot of a professional diver exploring the vibrant underwater world of the Guraici Islands.',
            'short_description' => 'Explore the vibrant underwater world of the Guraici Islands.',
            'rating' => 5.0,
            'review_count' => 200,
            'price' => 50000,
            'is_featured' => true
        ]);

        Destination::create([
            'name' => 'Bibinoi Waterfall',
            'slug' => 'bibinoi-waterfall',
            'category' => 'Adventure',
            'location' => 'South Bacan',
            'latitude' => -0.70000000,
            'longitude' => 127.60000000,
            'description' => 'The dramatic Bibinoi Waterfall in South Halmahera, where powerful white water cascades down a dark volcanic rock face.',
            'short_description' => 'The dramatic Bibinoi Waterfall in South Halmahera.',
            'rating' => 4.8,
            'review_count' => 150,
            'price' => 15000,
            'is_featured' => true
        ]);

        // Events
        Event::create([
            'name' => 'Festival Bacan 2024',
            'slug' => 'festival-bacan-2024',
            'description' => 'Celebrating the royal heritage and natural wonders of the Bacan Sultanate.',
            'short_description' => 'Celebrating the royal heritage and natural wonders of the Bacan Sultanate.',
            'location' => 'Labuha City',
            'start_date' => '2024-10-15',
            'end_date' => '2024-10-20',
            'is_featured' => true
        ]);
        
        Event::create([
            'name' => 'Halmahera Marine Expo',
            'slug' => 'halmahera-marine-expo-2024',
            'description' => 'A showcase of regional maritime culture, underwater technology, and diving spots.',
            'short_description' => 'A showcase of regional maritime culture, underwater technology, and diving spots.',
            'location' => 'Bacan Port',
            'start_date' => '2024-11-12',
            'end_date' => '2024-11-14',
            'is_featured' => true
        ]);
        
        Event::create([
            'name' => 'Culinary Heritage Week',
            'slug' => 'culinary-heritage-week-2024',
            'description' => 'Taste the authentic flavors of South Halmahera, from land to sea.',
            'short_description' => 'Taste the authentic flavors of South Halmahera, from land to sea.',
            'location' => 'Labuha Square',
            'start_date' => '2024-12-05',
            'end_date' => '2024-12-10',
            'is_featured' => true
        ]);

        // Travel Packages
        TravelPackage::create([
            'name' => 'Bacan Island Paradise',
            'slug' => 'bacan-island-paradise',
            'theme' => 'Leisure',
            'description' => 'Complete tour of historical sites and pristine beaches in Bacan Island.',
            'short_description' => 'Complete tour of historical sites and pristine beaches in Bacan Island.',
            'duration_days' => 3,
            'duration_nights' => 2,
            'price_per_pax' => 3500000,
            'rating' => 4.9,
            'is_featured' => true
        ]);

        TravelPackage::create([
            'name' => 'Guraici Diving Quest',
            'slug' => 'guraici-diving-quest',
            'theme' => 'Diving',
            'description' => 'An immersive diving experience for professionals and enthusiasts alike.',
            'short_description' => 'An immersive diving experience for professionals and enthusiasts alike.',
            'duration_days' => 5,
            'duration_nights' => 4,
            'price_per_pax' => 7500000,
            'rating' => 5.0,
            'is_featured' => true
        ]);

        TravelPackage::create([
            'name' => 'Hidden Lagoon Retreat',
            'slug' => 'hidden-lagoon-retreat',
            'theme' => 'Romance',
            'description' => 'Relax in luxury at the most secluded and private lagoons in Halsea.',
            'short_description' => 'Relax in luxury at the most secluded and private lagoons in Halsea.',
            'duration_days' => 4,
            'duration_nights' => 3,
            'price_per_pax' => 5500000,
            'rating' => 4.8,
            'is_featured' => true
        ]);
    }
}
