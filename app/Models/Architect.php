<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Staudenmeir\EloquentHasManyDeep\HasRelationships as HasDeepRelationships;

class Architect extends Model
{
    use HasFactory;
    use HasDeepRelationships;


    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    // Note this includes both nominations and awarded awards
    public function awards()
    {
        return $this->hasManyDeep(Award::class, ['architect_work', Work::class, 'award_work']);
    }

    public function works()
    {
        return $this->belongsToMany(Work::class);
    }

    public function getLastNameAttribute($value)
    {
        return Str::title($value);
    }
}
