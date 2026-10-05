<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['is_active' => 'boolean'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Scope: produk yang aktif dijual
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    // Scope: produk yang stoknya masih ada
    public function scopeInStock(Builder $query): void
    {
        $query->where('stock', '>', 0);
    }
}