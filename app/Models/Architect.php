<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Staudenmeir\EloquentHasManyDeep\HasRelationships as HasDeepRelationships;

class Architect extends Model
{
    use HasFactory;
    use HasDeepRelationships;

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

    public function getAuthorizationsAttribute()
    {
        return $this->numbers->map->authorization;
    }

    public function scopeFiltered(Builder $query, Request $request)
    {
        if ($request->filled('q')) {
            $query->where('last_name', 'like', "%{$request->query('q')}%");
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

        if ($request->filled('locationDistrictsIn')) {
            $query->whereHas('address', function (Builder $query) use ($request) {
                $query->whereIn('location_district', $request->query('locationDistrictsIn'));
            });
        }

        return $query;
    }
}
