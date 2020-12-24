<?php

namespace App\Models;

use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

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
        'text',
    ];

    public $with = ['tags'];

    protected $table = 'posts';
    protected $guarded = ['id'];
    protected $dates = ['published_at'];

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
        return action('\App\Http\Controllers\PostsController@show', $this->slug);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
