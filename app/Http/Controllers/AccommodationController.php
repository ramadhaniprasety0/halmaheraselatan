<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Accommodation;

class AccommodationController extends Controller
{
    public function index(Request $request)
    {
        $query = Accommodation::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $query->orderBy('price_per_night', 'asc'),
                'price_desc' => $query->orderBy('price_per_night', 'desc'),
                'rating' => $query->orderBy('rating', 'desc'),
                default => $query->orderBy('is_featured', 'desc')->latest(),
            };
        } else {
            $query->orderBy('is_featured', 'desc')->latest();
        }

        $featuredAccommodation = Accommodation::where('is_featured', true)->first();
        $types = Accommodation::distinct()->pluck('type')->filter();
        $accommodations = $query->paginate(12)->withQueryString();

        return view('accommodations.index', compact('accommodations', 'featuredAccommodation', 'types'));
    }

    public function show($slug)
    {
        $accommodation = Accommodation::where('slug', $slug)->firstOrFail();
        return view('accommodations.show', compact('accommodation'));
    }
}