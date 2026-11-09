<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'tagline', 'avatar', 'bio_short', 'bio_long',
        'email', 'phone', 'location', 'age', 'degree',
        'github_url', 'linkedin_url', 'twitter_url', 'cv_file', 'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public static function current(): self
    {
        return self::firstOrCreate([], ['name' => 'Anup Devkota']);
    }

    public function avatarUrl(): string
    {
        if ($this->avatar && file_exists(public_path('storage/' . $this->avatar))) {
            return asset('storage/' . $this->avatar);
        }
        return '';
    }
}
