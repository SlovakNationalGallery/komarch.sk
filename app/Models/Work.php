<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Work extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTags;

    public function awards()
    {
        return $this->belongsToMany(Award::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images')
            ->withResponsiveImages();
    }
}
