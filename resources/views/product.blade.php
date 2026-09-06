@extends('Layouts.master')

@section('content')
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">The</span> Collection</h3>
                    <p>Signature frames and finishing touches, selected for everyday wear.</p>
                </div>
            </div>
        </div>
        @if ($search)
        <p class="text-center mb-4">Search results for “{{ $search }}”</p>
        @endif
        <div class="row">
            @forelse ($products as $product)
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image"><a href="{{ route('products.show', $product) }}"><img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}"></a></div>
                    <h3>{{ $product->name }}</h3>
                    <p class="product-price"><span>{{ $product->categoryRelation?->name ?? $product->category }}</span> ${{ number_format($product->price, 2) }}</p>
                    <form method="POST" action="{{ route('cart.store', $product) }}" class="cart-async-form">
                        @csrf
                        <button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>No accessories matched your search.</p>
            </div>
            @endforelse
        </div>
        @if ($products->hasPages())
        <nav class="store-pagination" aria-label="Product pagination">
            <p class="store-pagination-summary">
                Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
            </p>
            <div class="store-pagination-links">
                @if ($products->onFirstPage())
                <span class="store-pagination-button is-disabled" aria-disabled="true">&laquo; Previous</span>
                @else
                <a class="store-pagination-button" href="{{ $products->previousPageUrl() }}">&laquo; Previous</a>
                @endif

                @for ($page = 1; $page <= $products->lastPage(); $page++)
                    @if ($page === $products->currentPage())
                    <span class="store-pagination-number is-current" aria-current="page">{{ $page }}</span>
                    @else
                    <a class="store-pagination-number" href="{{ $products->url($page) }}">{{ $page }}</a>
                    @endif
                    @endfor

                    @if ($products->hasMorePages())
                    <a class="store-pagination-button" href="{{ $products->nextPageUrl() }}">Next &raquo;</a>
                    @else
                    <span class="store-pagination-button is-disabled" aria-disabled="true">Next &raquo;</span>
                    @endif
            </div>
        </nav>
        @endif
    </div>
</div>
@endsection