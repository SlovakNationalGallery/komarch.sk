<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ContestResult extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'contestresults';

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('contestresult_pictures')
            ->withResponsiveImages();
    }
}
