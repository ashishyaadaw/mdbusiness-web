<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategories extends Model
{
    protected $fillable = ['name', 'icon', 'desc'];

    protected $table = 'menu_category';

    public function menus()
    {
        return $this->hasMany(Menu::class, 'menu_category_id');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_menu_category')
            ->withTimestamps();
    }
}
