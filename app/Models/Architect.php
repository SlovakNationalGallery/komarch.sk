<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use Staudenmeir\EloquentHasManyDeep\HasRelationships as HasDeepRelationships;

class Architect extends Model
{
    use HasFactory;
    use HasDeepRelationships;
    use Searchable;

    public $incrementing = false;

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    // Note this includes both nominations and awarded awards
    public function awards()
    {
        return $this->hasManyDeep(Award::class, ['architect_work', Work::class, 'award_work']);
    }

    public function contests()
    {
        return $this->belongsToMany(Contest::class)->withPivot('depended', 'type');
    }

    public function numbers()
    {
        return $this->hasMany(Number::class);
    }

    public function works()
    {
        return $this->belongsToMany(Work::class);
    }

    public function getLastNameAttribute($value)
    {
        return Str::title($value);
    }

    public function getFullNameAttribute()
    {
        return collect([
            $this->title_before,
            $this->first_name,
            $this->last_name,
            $this->title_after
        ])->filter()->join(' ');
    }

    public function getUrlAttribute(): string
    {
        return route('architects.detail', [$this->id, $this->slug]);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->full_name);
    }

    public function getAuthorizationsAttribute()
    {
        return $this->numbers->map->authorization;
    }

    public function scopeFiltered(Builder $query, Request $request)
    {
        if ($request->filled('q')) {
            $searchResultIds = self::search("*{$request->query('q')}*")->keys();
            $query->whereIn('architects.id', $searchResultIds);
        }

        if ($request->filled('startsWith')) {
            $query->where('last_name', 'like', "{$request->query('startsWith')}%");
        }

        if ($request->filled('authorizationsIn')) {
            $query->whereHas('numbers', function (Builder $query) use ($request) {
                // Search by a regexp like: (AA|BB)$
                $regexp = '(' . join('|', $request->query('authorizationsIn')) . ')$';
                $query->where('architect_number', 'REGEXP', $regexp);
            });
        }

        return $query;
    }

    public function toSearchableArray()
    {
        return Arr::only($this->toArray(), ['first_name', 'last_name']);
    }
}
