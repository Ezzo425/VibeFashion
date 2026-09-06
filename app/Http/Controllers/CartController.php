<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $this->cart($request);
        $cart->load('products.categoryRelation');

        return view('cart', compact('cart'));
    }

    public function store(Request $request, Product $product): Response
    {
        abort_if($product->stock < 1, 422, 'This product is currently out of stock.');

        $cart = $this->cart($request);
        $item = $cart->products()->whereKey($product->id)->first();
        $quantity = $item ? $item->pivot->quantity + 1 : 1;

        if ($quantity > $product->stock) {
            return back()->with('error', 'There are not enough units available for this item.');
        }

        $cart->products()->syncWithoutDetaching([$product->id => ['quantity' => $quantity]]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => "{$product->name} added to your cart.",
                'item_count' => $cart->fresh('products')->item_count,
            ]);
        }

        return back()->with('success', "{$product->name} added to your cart.");
    }

    public function update(Request $request, Product $product): Response
    {
        $validated = $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:99']]);
        abort_if($validated['quantity'] > $product->stock, 422, 'The requested quantity is not available.');

        $this->cart($request)->products()->updateExistingPivot($product->id, ['quantity' => $validated['quantity']]);

        if ($request->expectsJson()) {
            $cart = $this->cart($request)->load('products');

            return response()->json([
                'message' => 'Cart updated.',
                'line_total' => number_format($product->price * $validated['quantity'], 2),
                'total' => number_format($cart->total, 2),
                'item_count' => $cart->item_count,
            ]);
        }

        return back()->with('success', 'Cart updated.');
    }

    public function destroy(Request $request, Product $product): Response
    {
        $this->cart($request)->products()->detach($product->id);

        if ($request->expectsJson()) {
            $cart = $this->cart($request)->load('products');

            return response()->json([
                'message' => 'Item removed from your cart.',
                'total' => number_format($cart->total, 2),
                'item_count' => $cart->item_count,
            ]);
        }

        return back()->with('success', 'Item removed from your cart.');
    }

    private function cart(Request $request): Cart
    {
        $cartId = $request->session()->get('cart_id');
        $cart = $cartId ? Cart::find($cartId) : null;

        if (! $cart) {
            $cart = Cart::create(['session_id' => $request->session()->getId()]);
            $request->session()->put('cart_id', $cart->id);
        }

        return $cart;
    }
}
