<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Ensure you have a Flag model

class City extends Model
{
    protected $fillable = ['name', 'state_code', 'country_code', 'is_active'];

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'like', "%{$term}%");
    }

    /**
     * Get the global 'city' active flag from the flags table.
     * Use an Attribute (Accessor) for easy access: $city->is_active_flag
     */
    public function getIsActiveFlagAttribute()
    {
        // Fetches the first record from flags and returns the 'city' boolean
        return Flag::value('city');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

    // Fixed: Your previous method pointed to Menu::class instead of MenuCategory::class
    public function menuCategories()
    {
        return $this->belongsToMany(MenuCategory::class);
    }
    public function is_active()
    {
        return Flag::where('id',$this->id)->where('city', true)->exists();;
    }


}
