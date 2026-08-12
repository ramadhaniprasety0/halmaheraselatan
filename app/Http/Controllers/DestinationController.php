<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Destination;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::query();
        
        if ($request->filled('category') && $request->category !== 'All') {
            $category = $request->category;
            // Map category chips to DB values
            if ($category === 'Pristine Beaches') {
                $category = 'Beaches';
            } elseif ($category === 'Diving & Snorkeling') {
                $category = 'Diving';
            } elseif ($category === 'Cultural Heritage') {
                $category = 'Culture';
            } elseif ($category === 'Rainforest Treks') {
                $category = 'Nature';
            }
            $query->where('category', $category);
        }
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->filled('location') && $request->location !== 'Location') {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        
        if ($request->filled('rating') && $request->rating !== 'Rating') {
            if ($request->rating === '4.5') {
                $query->where('rating', '>=', 4.5);
            } elseif ($request->rating === '4.0') {
                $query->where('rating', '>=', 4.0);
            }
        }
        
        $destinations = $query->paginate(12)->withQueryString();
        
        $featured = Destination::where('is_featured', true)->first() 
            ?? Destination::orderBy('rating', 'desc')->first();
        
        return view('destinations.index', compact('destinations', 'featured'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        return view('destinations.show', compact('destination'));
    }
}
