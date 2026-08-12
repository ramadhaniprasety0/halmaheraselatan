<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Culinary;

class CulinaryController extends Controller
{
    public function index()
    {
        $culinaries = Culinary::paginate(12);
        return view('culinary.index', compact('culinaries'));
    }

    public function show($slug)
    {
        $culinary = Culinary::where('slug', $slug)->firstOrFail();
        return view('culinary.show', compact('culinary'));
    }
}