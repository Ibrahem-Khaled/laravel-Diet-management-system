<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealOption extends Model
{
    protected $guarded = ['id'];

    public function meals()
    {
        return $this->belongsTo(Meal::class);
    }

    public function options()
    {
        return $this->belongsTo(Option::class);
    }
}
