<?php

namespace App\Models;

use App\Traits\Publishable;
use App\Traits\HasCoverImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\HasShortDescription;

class Page extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory,
        HasSlug,
        HasTags,
        Publishable,
        HasTranslations,
        CrudTrait,
        InteractsWithMedia,
        HasCoverImage,
        HasShortDescription;

    public $translatable = [
        'title',
        'text',
    ];

    public $with = ['tags'];

    protected $table = 'pages';
    protected $fillable = [
        'id',
        'parent_id',
        'title',
        'slug',
        'menu_order',
        'text',
        'wp_post_name',
        'published_at',
        'cover_image',
        'redirect_url',
    ];
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
        if ($this->redirect_url) {
            return $this->redirect_url;
        }
        return action('\App\Http\Controllers\PagesController@show', $this->slug);
    }

    public function setParentIdAttribute($value)
    {
        $this->attributes['parent_id'] = (is_null($value)) ? 0 : $value;
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
        return $this->hasMany(self::class, 'parent_id')->orderBy('menu_order');
    }

    public function getBreadcrumbsAttribute()
    {
        $breadcrumbs[] = $this;
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

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover')
            ->acceptsMimeTypes(['image/jpeg', 'image/gif', 'image/png'])
            ->withResponsiveImages();
    }

    public function getShortDescriptionAttribute()
    {
        return $this->shortenString($this->text);
    }

    /**
     * returns nested-list of page titles
     */
    public static function getTree($only_parents = false, $parent_id = 0, $spacing = '', $tree_array = []): array
    {
        $categories = self::select('id', 'title', 'parent_id')->where('parent_id' ,'=', $parent_id)->orderBy('menu_order')->get();
        foreach ($categories as $item){
            if (!$only_parents || $item->children()->exists()) {
                $tree_array[$item->id] = $spacing . ' ' . $item->title;
                $tree_array = self::getTree($only_parents, $item->id, $spacing . '—', $tree_array);
            }
        }
        return $tree_array;
    }

}
