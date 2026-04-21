<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityMenu extends Model
{
    protected $table = 'city_menu';
    protected $fillable = ['city_id', 'menu_id'];

    // In Menu.php
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}