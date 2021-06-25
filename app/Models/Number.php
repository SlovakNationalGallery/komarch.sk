<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;

    public function architect()
    {
        return $this->belongsTo(Architect::class);
    }

    public function getAuthorizationAttribute()
    {
        return substr($this->architect_number, -2);
    }
}
