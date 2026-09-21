<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


public function getRouteKeyName(): string
{
    return 'slug';
}

public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}


public function reviews()
{
    return $this->hasMany(Review::class);
}




public function getAverageRatingAttribute()
{
    return round($this->reviews()->avg('rating'), 1);
}



public function getReviewsCountAttribute()
{
    return $this->reviews()->count();
}





public function wishlistedBy()
{
    return $this->belongsToMany(User::class, 'wishlist');
}




}
