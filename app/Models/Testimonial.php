<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'role', 'avatar', 'avatar_initials', 'avatar_color',
        'content', 'stars', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'stars'     => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
