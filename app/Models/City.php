<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $fillable = ['name', 'state_code', 'country_code', 'is_active'];

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'like', "%{$term}%");
    }

    public function menus()
{
    return $this->belongsToMany(Menu::class);
}
}