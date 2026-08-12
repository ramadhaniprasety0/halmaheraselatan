<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TravelPackage;

class TravelPackageController extends Controller
{
    public function index()
    {
        $packages = TravelPackage::orderBy('id', 'desc')->paginate(12);
        return view('packages.index', compact('packages'));
    }

    public function show($slug)
    {
        $package = TravelPackage::where('slug', $slug)->firstOrFail();
        return view('packages.show', compact('package'));
    }
}