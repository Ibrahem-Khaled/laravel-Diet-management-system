<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(PackageCategory::class);
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'meal_packages', 'package_id', 'meal_id')
        ->withPivot('type', 'date');
    }
}
