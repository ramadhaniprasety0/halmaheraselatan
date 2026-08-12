<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'name' => 'Festival Budaya Bacan',
                'description' => 'The grandest annual celebration showcasing the majestic traditions of the Bacan Sultanate. Witness the legendary Cakalang boat parade, sacred ritual dances, and an island-wide culinary fair featuring royal recipes passed down through generations.',
                'short_description' => 'The grandest annual celebration showcasing the majestic traditions of the Bacan Sultanate.',
                'location' => 'Labuha Waterfront',
                'start_date' => now()->addDays(15),
                'end_date' => now()->addDays(20),
                'price' => 0,
                'organizer' => 'Pemerintah Kabupaten Halmahera Selatan',
                'category' => 'Culture',
                'is_featured' => true,
                'status' => 'published',
            ],
            [
                'name' => 'Widi International Fishing',
                'description' => 'High-action sport fishing scene in the Widi Islands of Halmahera. A professional angler battles a large fish on a luxury boat deck.',
                'short_description' => 'High-action sport fishing scene in the Widi Islands of Halmahera.',
                'location' => 'Widi Islands',
                'start_date' => now()->addDays(30),
                'end_date' => now()->addDays(35),
                'price' => 500000,
                'organizer' => 'Widi Fishing Club',
                'category' => 'Sports',
                'is_featured' => false,
                'status' => 'published',
            ],
            [
                'name' => 'Batu Bacan Expo',
                'description' => 'A sophisticated exhibition space displaying rare green Chrysocolla-in-Chalcedony (Batu Bacan) gemstones.',
                'short_description' => 'Exhibition displaying rare green Chrysocolla-in-Chalcedony gemstones.',
                'location' => 'Labuha Center',
                'start_date' => now()->addDays(45),
                'end_date' => now()->addDays(48),
                'price' => 50000,
                'organizer' => 'Asosiasi Pengrajin Batu Bacan',
                'category' => 'Exhibition',
                'is_featured' => false,
                'status' => 'published',
            ]
        ];

        foreach ($events as $event) {
            Event::create(array_merge($event, [
                'slug' => Str::slug($event['name'])
            ]));
        }
    }
}
