@extends('Layouts.master')

@section('content')
<div class="container admin-page mt-150 mb-150">
    <div class="admin-heading">
        <div>
            <p class="eyebrow">Control center</p>
            <h1>VibeFashion Admin</h1>
            <p>Manage the catalog, review customers, and follow incoming orders.</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">@csrf<button class="bordered-btn" type="submit">Sign out</button></form>
    </div>
    <div class="admin-stats">
        <div><strong>{{ $products->count() }}</strong><span>Products</span></div>
        <div><strong>{{ $customers->count() }}</strong><span>Customers</span></div>
        <div><strong>{{ $orders->count() }}</strong><span>Recent orders</span></div>
    </div>
    <div class="admin-card">
        <h2>Add product</h2>
        <form method="POST" action="{{ route('admin.products.store') }}" class="admin-form">
            <div><input name="name" placeholder="Product name" required><select name="category_id" required>@foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach</select><input name="price" type="number" step="0.01" placeholder="Price" required><input name="stock" type="number" placeholder="Stock" required><input name="image_path" placeholder="assets/img/products/file.jpg" required></div><textarea name="description" placeholder="Description"></textarea><button class="boxed-btn" type="submit">Add product</button>
        </form>
    </div>
    <div class="admin-card">
        <h2>Products</h2>
        <div class="admin-table">@foreach($products as $product)<div class="admin-row admin-product-row">
                <form method="POST" action="{{ route('admin.products.update', $product) }}" class="admin-inline-form">@csrf @method('PATCH')<input name="name" value="{{ $product->name }}" required><input name="price" type="number" step="0.01" value="{{ $product->price }}" required><input name="stock" type="number" value="{{ $product->stock }}" required><input type="hidden" name="category_id" value="{{ $product->category_id }}"><input type="hidden" name="image_path" value="{{ $product->image_path }}"><input type="hidden" name="description" value="{{ $product->description }}"><button class="boxed-btn" type="submit">Save</button></form>
                <form method="POST" action="{{ route('admin.products.destroy', $product) }}">@csrf @method('DELETE')<button class="icon-delete" type="submit" aria-label="Delete {{ $product->name }}"><i class="fas fa-trash"></i></button></form>
            </div>@endforeach</div>
    </div>
    <div class="admin-card">
        <h2>Customers</h2>
        <div class="admin-table">@forelse($customers as $customer)<div class="admin-row"><span><strong>{{ $customer->name }}</strong><small>{{ $customer->email }} · {{ $customer->phone ?: 'No phone' }}</small></span><span>{{ $customer->orders_count }} orders</span></div>@empty<p>No customers yet.</p>@endforelse</div>
    </div>
    <div class="admin-card">
        <h2>Recent orders</h2>
        <div class="admin-table">@forelse($orders as $order)<div class="admin-row"><span><strong>#{{ $order->id }} · {{ $order->user->name }}</strong><small>{{ $order->created_at->format('M j, Y g:i A') }}</small></span><span>{{ ucfirst($order->status) }} · ${{ number_format($order->total, 2) }}</span></div>@empty<p>No orders yet.</p>@endforelse</div>
    </div>
</div>
@endsection