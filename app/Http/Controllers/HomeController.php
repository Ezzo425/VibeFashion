<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('categoryRelation')->where('is_featured', true)->latest()->take(3)->get();

        return view('welcome', compact('featuredProducts'));
    }
}
