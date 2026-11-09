<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name', 'category', 'level', 'color', 'icon',
        'bg_color', 'border_color', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'level'     => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeTechnical($query)
    {
        return $query->where('category', 'technical');
    }

    public function scopeStack($query)
    {
        return $query->where('category', 'stack');
    }
}
