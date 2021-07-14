<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Illuminate\Support\Str;
use App\Traits\HasShortDescription;

class Work extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory, InteractsWithMedia, HasTags, HasShortDescription;

    public $incrementing = false;

    public $with = ['other_architects', 'awards'];

    public static $filterable = ['other_architects', 'awards'];

    public function awards()
    {
        return $this->belongsToMany(Award::class);
    }

    public function citationPublications()
    {
        return $this->belongsToMany(
            CitationPublication::class,
            'citation_publication_work',
            'work_id',
            'publication_id'
        );
    }

    public function other_architects()
    {
        return $this->morphToMany(Tag::class, 'taggable')->where('type', 'other_architect');
    }

    public function functions()
    {
        return $this->morphToMany(Tag::class, 'taggable')->where('type', '');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('work_pictures')
            ->withResponsiveImages();
    }

    public function getUrlAttribute(): string
    {
        return route('works.detail', [$this->id, $this->slug]);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }

    public function getCoverImageAttribute()
    {
        return $this->getFirstMedia('work_pictures');
    }

    public function getFiltersAttribute()
    {
        $tags = [
            $this->awards->pluck('name')->all(),
            $this->location_city,
            (string)$this->year,
            // @TODO functions
        ];

        return Arr::flatten(Arr::where($tags, fn ($tag) => !empty($tag)));
    }

    public function getYearAttribute()
    {
        // @TODO -> years span or just single year? date_design_start or date_construction_start ?
        return $this->date_design_start;
    }

    public function getShortDescriptionAttribute()
    {
        return $this->shortenString($this->annotation);
    }

    public function getDateDesignAttribute()
    {
        return $this->yearsSpan($this->date_design_start, $this->date_design_ending);
    }

    public function getDateConstructionAttribute()
    {
        return $this->yearsSpan($this->date_construction_start, $this->date_construction_ending);
    }

    public function getLocationAttribute()
    {
        if (!$this->has_public_location) {
            return $this->location_city;
        }

        $result = $this->location_street;
        if ($this->location_descriptive_number) {
            $result .=  ' ' . $this->location_descriptive_number;
        }
        if ($this->location_city) {
            $result .=  (!empty($result)) ? ', ' : '';
            $result .=  $this->location_city;
        }
        return $result;

    }

    public function yearsSpan($start, $ending)
    {
        $result = $start;
        if ($ending) {
            $result .= ' - ' . $ending;
        }
        return $result;
    }


}
