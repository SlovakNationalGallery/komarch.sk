<?php

namespace App\Models;

use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Page extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory,
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

    protected $table = 'pages';
    protected $guarded = [];
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
        return action('\App\Http\Controllers\PagesController@show', $this->slug);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getBreadcrumbsAttribute()
    {
        $breadcrumbs = [];
        $id = $this->parent_id;
        while ($id!=0) {
            $model = self::find($id);
            $breadcrumbs[] = self::find($id);
            $id = $model->parent_id;
        }
        $breadcrumbs = array_reverse($breadcrumbs);

        return collect($breadcrumbs);
    }

    public function scopeTopMenu($query)
    {
        return $query->menu()->where('parent_id', '=', 0);
    }

    public function scopeMenu($query)
    {
        return $query->whereNotNull('menu_order')
                     ->orderBy('menu_order');
    }

}
