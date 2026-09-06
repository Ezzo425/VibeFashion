@extends('Layouts.master')

@section('content')
<div class="container checkout-page mt-150 mb-150">
    <div class="checkout-heading">
        <p class="eyebrow">Secure checkout</p>
        <h1>Complete your order</h1>
        <p>We will use your saved account details to prepare delivery in Cairo and across Egypt.</p>
    </div>
    <div class="row g-5">
        <div class="col-lg-7">
            <form method="POST" action="{{ route('checkout.store') }}" class="checkout-card">
                @csrf
                <h3>Delivery details</h3>
                <label>Name<input name="shipping_name" value="{{ old('shipping_name', auth()->user()->name) }}" required></label>
                <label>Phone<input name="shipping_phone" value="{{ old('shipping_phone', auth()->user()->phone) }}" required></label>
                <label>Address<textarea name="shipping_address" rows="4" required>{{ old('shipping_address', auth()->user()->address) }}</textarea></label>
                <button class="boxed-btn" type="submit">Place order</button>
            </form>
        </div>
        <div class="col-lg-5">
            <div class="checkout-card order-review">
                <h3>Order review</h3>@foreach ($cart->products as $product)<div class="review-line"><span>{{ $product->name }} × {{ $product->pivot->quantity }}</span><strong>${{ number_format($product->price * $product->pivot->quantity, 2) }}</strong></div>@endforeach
                <hr>
                <div class="review-total"><span>Total</span><strong>${{ number_format($cart->total, 2) }}</strong></div>
            </div>
        </div>
    </div>
</div>
@endsection