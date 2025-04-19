<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = ['id'];

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_options', 'meal_id', 'option_id');
    }
}
