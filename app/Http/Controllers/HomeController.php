<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Destination;
use App\Models\Event;
use App\Models\TravelPackage;

class HomeController extends Controller
{
    public function index()
    {
        $destinations = Destination::where('is_featured', true)->take(4)->get();
        $events = Event::where('is_featured', true)->orderBy('start_date', 'asc')->take(3)->get();
        $packages = TravelPackage::where('is_featured', true)->take(3)->get();

        return view('welcome', compact('destinations', 'events', 'packages'));
    }
}
