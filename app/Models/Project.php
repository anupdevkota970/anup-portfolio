<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'icon', 'color', 'tags',
        'demo_url', 'code_url', 'is_featured', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'tags'        => 'array',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
