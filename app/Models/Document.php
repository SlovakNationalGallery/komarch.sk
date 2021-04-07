<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;
use App\Traits\CreatedBy;

class Document extends Model implements HasMedia
{
    use HasTags,
        InteractsWithMedia,
        CrudTrait,
        CreatedBy;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'documents';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'file',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('file');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function types()
    {
        return $this->morphToMany(Tag::class, 'taggable')->where('type', 'document-type');
    }

    public function topics()
    {
        return $this->morphToMany(Tag::class, 'taggable')->where('type', 'document-topic');
    }

    public function roles()
    {
        return $this->morphToMany(Tag::class, 'taggable')->where('type', 'document-role');
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getFileAttribute()
    {
        return $this->getFirstMedia('file');
    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setFileAttribute($uploaded_file)
    {

        $this->clearMediaCollection('file');
        if (isSet($uploaded_file)) {
            $this
                ->addMedia($uploaded_file)
                // ->usingFileName($uploaded_file->hashName())
                ->toMediaCollection('file');
        }
    }



}
