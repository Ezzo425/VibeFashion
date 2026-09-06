<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    protected $fillable = ['session_id'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'cart_items')->withPivot('quantity')->withTimestamps();
    }

    public function getTotalAttribute(): float
    {
        return (float) $this->products->sum(fn (Product $product) => $product->price * $product->pivot->quantity);
    }

    public function getItemCountAttribute(): int
    {
        return (int) $this->products->sum('pivot.quantity');
    }
}
