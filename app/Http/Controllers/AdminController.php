<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'products' => Product::with('categoryRelation')->latest()->get(),
            'customers' => User::where('role', 'customer')->withCount('orders')->latest()->get(),
            'orders' => Order::with('user')->latest()->take(10)->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function storeProduct(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'image_path' => ['required', 'string', 'max:255'],
        ]);
        $category = Category::findOrFail($data['category_id']);
        $data['category'] = $category->name;
        $data['is_featured'] = $request->boolean('is_featured');
        Product::create($data);

        return back()->with('success', 'Product created.');
    }

    public function updateProduct(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'image_path' => ['required', 'string', 'max:255'],
        ]);
        $category = Category::findOrFail($data['category_id']);
        $data['category'] = $category->name;
        $data['is_featured'] = $request->boolean('is_featured');
        $product->update($data);

        return back()->with('success', 'Product updated.');
    }

    public function destroyProduct(Product $product): RedirectResponse
    {
        $product->delete();

        return back()->with('success', 'Product deleted.');
    }
}
