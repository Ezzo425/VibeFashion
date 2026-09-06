@extends('Layouts.master')

@section('content')
<div class="container mt-150 mb-150">
    <div class="row">
        <div class="col-lg-7">
            <div class="section-title">
                <h3><span class="orange-text">Our</span> Point of View</h3>
                <p>VibeFashion is an accessories shop for people who believe the smallest details can change the whole feeling of an outfit.</p>
                <p>We choose wearable frames, necklaces, rings, and bracelets that balance character with ease. Every piece is designed to become part of your own signature.</p>
                <p>Our collection brings together expressive eyewear and refined accessories that are easy to style, comfortable to wear, and made to move with your everyday life. Whether you are dressing for a busy morning in Cairo or an evening with friends, the right detail can make the look feel complete.</p>
                <p>We believe shopping should feel personal and uncomplicated. That is why we carefully organize our collection by category, show clear product details, and make it simple to save your favorite pieces in one cart.</p>
                <p>From the first pair of frames you reach for every day to the ring or necklace that becomes part of your story, VibeFashion is here to help you express your style with confidence.</p>
            </div>
        </div>
        <div class="col-lg-5">
            <img src="{{ asset('assets/img/products/jewelry-display.jpg') }}" alt="VibeFashion jewelry collection">
        </div>
    </div>
</div>
@endsection