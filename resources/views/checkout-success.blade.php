@extends('Layouts.master')

@section('content')
<div class="container auth-page mt-150 mb-150">
    <div class="auth-card text-center">
        <div class="success-mark"><i class="fas fa-check"></i></div>
        <p class="eyebrow">Order received</p>
        <h1>Thank you, {{ auth()->user()->name }}</h1>
        <p class="auth-intro">Your order <strong>#{{ $order->id }}</strong> has been placed successfully. We will contact you before dispatch.</p>
        <p class="order-total">Order total: <strong>${{ number_format($order->total, 2) }}</strong></p><a href="{{ route('products.index') }}" class="boxed-btn">Continue shopping</a>
    </div>
</div>
@endsection