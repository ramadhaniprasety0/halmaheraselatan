<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Destination extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['id'];

    protected $casts = [
        'facilities' => 'array',
        'opening_hours' => 'array',
    ];

    protected $appends = ['image_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('default') ?: 'https://via.placeholder.com/200x100';
    }
}
