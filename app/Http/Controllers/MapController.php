<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Destination;

class MapController extends Controller
{
    public function index()
    {
        $destinations = Destination::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $events = \App\Models\Event::whereNotNull('latitude')->whereNotNull('longitude')->get();
        return view('map.index', compact('destinations', 'events'));
    }
}
