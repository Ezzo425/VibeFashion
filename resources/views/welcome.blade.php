@extends('Layouts.master')

@section('content')
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Our</span> Products</h3>
                    <p>Thoughtful eyewear and jewelry for the way you show up.</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($featuredProducts as $product)
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="{{ route('products.show', $product) }}"><img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}"></a>
                    </div>
                    <h3>{{ $product->name }}</h3>
                    <p class="product-price"><span>{{ $product->categoryRelation?->name ?? $product->category }}</span> ${{ number_format($product->price, 2) }}</p>
                    <form method="POST" action="{{ route('cart.store', $product) }}" class="cart-async-form">
                        @csrf
                        <button class="cart-btn" type="submit"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<section class="testimonial-section py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h3><span class="orange-text">Loved</span> by the Vibe</h3>
            <p>Pieces that earn a place in the everyday rotation.</p>
        </div>
        <div class="row testimonial-grid">
            <div class="col-lg-4 mb-4">
                <blockquote>“The frames feel like they were made for my face. Effortless, flattering, and beautifully packed.”<cite>Salma Hassan, Cairo</cite></blockquote>
            </div>
            <div class="col-lg-4 mb-4">
                <blockquote>“My necklace arrived quickly and looks even better layered with pieces I already own.”<cite>Nour Adel, Giza</cite></blockquote>
            </div>
            <div class="col-lg-4 mb-4">
                <blockquote>“A small ring stack, but it completely changed how I style my daily basics.”<cite>Omar Fathy, Alexandria</cite></blockquote>
            </div>
        </div>
    </div>
</section>
@endsection