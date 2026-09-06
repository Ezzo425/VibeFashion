<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function create(Request $request)
    {
        $cart = Cart::find($request->session()->get('cart_id'));
        abort_if(! $cart, 422, 'Your cart is empty.');
        $cart->load('products');
        abort_if($cart->products->isEmpty(), 422, 'Your cart is empty.');

        return view('checkout', compact('cart'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_phone' => ['required', 'string', 'max:30'],
            'shipping_address' => ['required', 'string', 'max:500'],
        ]);
        $cart = Cart::find($request->session()->get('cart_id'));
        abort_if(! $cart, 422, 'Your cart is empty.');
        $cart->load('products');
        abort_if($cart->products->isEmpty(), 422, 'Your cart is empty.');

        $order = DB::transaction(function () use ($cart, $data, $request) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'status' => 'pending',
                'total' => $cart->total,
                ...$data,
            ]);
            foreach ($cart->products as $product) {
                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $product->price,
                    'quantity' => $product->pivot->quantity,
                ]);
            }
            $cart->products()->detach();

            return $order;
        });
        $request->session()->forget('cart_id');

        return redirect()->route('checkout.success', $order);
    }

    public function success(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        return view('checkout-success', compact('order'));
    }
}
