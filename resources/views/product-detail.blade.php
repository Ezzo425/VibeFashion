@extends('Layouts.master')

@section('content')
<div class="container mt-150 mb-150 product-detail-page">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-lg-5 offset-lg-1 product-detail-copy">
            <p class="text-uppercase text-muted mb-2">{{ $product->categoryRelation?->name ?? $product->category }}</p>
            <h1>{{ $product->name }}</h1>
            <p class="product-price fs-3 mb-4">${{ number_format($product->price, 2) }}</p>
            <p class="mb-4">{{ $product->description }}</p>
            <p class="stock-note mb-4"><i class="fas fa-check-circle"></i> {{ $product->stock }} available for immediate dispatch</p>
            <form method="POST" action="{{ route('cart.store', $product) }}" class="cart-async-form">
                @csrf
                <button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </form>
        </div>
    </div>
</div>
@endsection