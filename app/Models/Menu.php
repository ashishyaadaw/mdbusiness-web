<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'menu_category_id', 'icon', 'status', 'type'];

    // In Menu.php
    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_menu');
    }
    public function category()
    {
        return $this->belongsTo(MenuCategories::class, 'menu_category_id');
    }
}