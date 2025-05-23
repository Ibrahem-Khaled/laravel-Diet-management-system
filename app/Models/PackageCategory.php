<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    protected $guarded = ['id'];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
