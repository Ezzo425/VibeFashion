<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $category = $request->query('category');

        $products = Product::query()->with('categoryRelation')
            ->when($search, fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhereHas('categoryRelation', fn ($query) => $query->where('name', 'like', "%{$search}%"))
                    ->orWhere('description', 'like', "%{$search}%");
            }))
            ->when($category, fn ($query) => $query->where(function ($query) use ($category) {
                $query->where('category', $category)
                    ->orWhereHas('categoryRelation', fn ($query) => $query->where('slug', $category)->orWhere('name', $category));
            }))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('product', compact('products', 'search', 'category'));
    }

    public function show(Product $product)
    {
        $product->load('categoryRelation');

        return view('product-detail', compact('product'));
    }

    public function categories()
    {
        $categories = Category::query()
            ->withCount('products')
            ->orderBy('name')
            ->get();

        return view('category', compact('categories'));
    }
}
