<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // Get the first featured event that hasn't ended yet
        $featuredEvent = Event::where('is_featured', true)
                              ->where('end_date', '>=', now()->startOfDay())
                              ->orderBy('start_date', 'asc')
                              ->first();
                              
        // If no featured event exists, just get the next upcoming one
        if (!$featuredEvent) {
            $featuredEvent = Event::where('end_date', '>=', now()->startOfDay())
                                  ->orderBy('start_date', 'asc')
                                  ->first();
        }

        // Get paginated events, excluding the featured one if it exists
        $eventsQuery = Event::orderBy('start_date', 'asc');
        if ($featuredEvent) {
            $eventsQuery->where('id', '!=', $featuredEvent->id);
        }
        $events = $eventsQuery->paginate(9); // 9 matches the 3-column grid design

        return view('events.index', compact('events', 'featuredEvent'));
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('events.show', compact('event'));
    }
}