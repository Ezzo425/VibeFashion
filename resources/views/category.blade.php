@extends('Layouts.master')

@section('content')
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">Shop by</span> Category</h3>
                    <p>Find the finishing piece that fits your mood and your wardrobe.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image"><a href="{{ route('products.index', ['category' => $category->slug]) }}"><img src="{{ asset($category->image_path) }}" alt="{{ $category->name }}"></a></div>
                    <h3>{{ $category->name }}</h3>
                    <p>{{ $category->products_count }} curated pieces</p>
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="boxed-btn">Browse collection</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection