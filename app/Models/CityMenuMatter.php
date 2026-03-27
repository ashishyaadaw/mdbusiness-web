<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityMenuMatter extends Model
{
    protected $table = 'city_menu_matter';

    protected $fillable = ['id', 'menu_id', 'city_id', 'matter_id'];

    // In Menu.php
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }
}
