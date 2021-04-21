<?php

namespace App\Models;

use App\Traits\Publishable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;

class Post extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory,
        Searchable,
        HasSlug,
        HasTags,
        Publishable,
        HasTranslations,
        CrudTrait;

    public $translatable = [
        'title',
        'perex',
        'text',
    ];

    public $with = ['tags'];

    protected $table = 'posts';
    protected $guarded = ['id'];
    protected $dates = ['published_at'];
    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getWordpressFullUrlAttribute(): string
    {
        return "/{$this->wp_post_name}";
    }

    public function getUrlAttribute(): string
    {
        return action('\App\Http\Controllers\PostsController@show', $this);
    }

    public function getExcerptAttribute(): ?string
    {
        if ($this->perex) {
            return $this->perex;
        }
        return Str::words(strip_tags($post->text), 70);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

}
