<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait CreatedBy
{

    public function save(array $options = [])
    {

        if (backpack_auth()->check())
        {
            if (!isset($this->created_by) || $this->created_by=='') {
                $this->created_by = backpack_user()->id;
            }

            $this->updated_by = backpack_user()->id;
        }

        parent::save();
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
