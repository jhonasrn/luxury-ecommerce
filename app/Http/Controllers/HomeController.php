<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $sunglasses = Product::where('category', 'Sunglasses')->inRandomOrder()->take(3)->get();
        $watches    = Product::where('category', 'Watches')->inRandomOrder()->take(3)->get();
        $bags       = Product::where('category', 'Bags')->inRandomOrder()->take(3)->get();
        $fragrances = Product::where('category', 'Fragrances')->inRandomOrder()->take(3)->get();

        return view('home', compact('sunglasses', 'watches', 'bags', 'fragrances'));
    }
}
