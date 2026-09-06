@extends('Layouts.master')

@section('content')
<div class="container py-5 cart-page">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
        <div>
            <span class="text-primary fw-semibold text-uppercase small">Your selection</span>
            <h1 class="display-6 fw-bold mb-2">Shopping Cart</h1>
            <p class="text-muted mb-0">Review your selected items before proceeding to checkout.</p>
        </div>
        <a href="{{ url('/') }}" class="btn btn-outline-dark rounded-pill px-4 mt-3 mt-md-0">
            <i class="bi bi-arrow-left me-2"></i>Continue shopping
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 px-4 pt-4 pb-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Cart items</h5>
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2"><span class="cart-count">{{ $cart->item_count }}</span> {{ $cart->item_count === 1 ? 'item' : 'items' }}</span>
                </div>
                <div class="card-body px-4 py-5 {{ $cart->products->isEmpty() ? 'text-center' : '' }}">
                    @if ($cart->products->isNotEmpty())
                    @foreach ($cart->products as $product)
                    <div class="cart-line d-flex gap-3 align-items-center border-bottom pb-3 mb-3" data-price="{{ $product->price }}">
                        <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="width: 76px; height: 76px; object-fit: cover;">
                        <div class="flex-grow-1 text-start">
                            <h5 class="mb-1">{{ $product->name }}</h5>
                            <small class="text-muted">{{ $product->categoryRelation?->name ?? $product->category }} · ${{ number_format($product->price, 2) }}</small>
                        </div>
                        <form method="POST" action="{{ route('cart.update', $product) }}" class="cart-async-form cart-quantity-form d-flex align-items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1" max="{{ $product->stock }}" class="form-control cart-quantity" style="width: 72px;" aria-label="Quantity for {{ $product->name }}">
                        </form>
                        <strong class="cart-line-total">${{ number_format($product->price * $product->pivot->quantity, 2) }}</strong>
                        <form method="POST" action="{{ route('cart.destroy', $product) }}" class="cart-async-form cart-remove-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Remove {{ $product->name }}"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    @endforeach
                    @else
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 76px; height: 76px;">
                        <i class="bi bi-bag fs-2"></i>
                    </div>
                    <h4 class="fw-bold">Your cart is empty</h4>
                    <p class="text-muted mb-4">Looks like you have not added anything to your cart yet.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill px-4">Explore products</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Order summary</h5>
                    <div class="d-flex justify-content-between text-muted mb-3">
                        <span>Subtotal</span><span class="cart-subtotal">${{ number_format($cart->total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted mb-3">
                        <span>Shipping</span><span>Calculated at checkout</span>
                    </div>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                        <span>Total</span><span class="cart-total">${{ number_format($cart->total, 2) }}</span>
                    </div>
                    @auth
                    <a href="{{ route('checkout.create') }}" class="btn btn-primary w-100 rounded-pill py-3">Proceed to checkout</a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-100 rounded-pill py-3">Sign in to checkout</a>
                    @endauth
                    <div class="d-flex align-items-center justify-content-center gap-2 text-muted small mt-4">
                        <i class="bi bi-shield-check text-success"></i> Secure checkout
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection