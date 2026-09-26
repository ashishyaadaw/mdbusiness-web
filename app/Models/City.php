<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Ensure you have a Flag model

class City extends Model
{
    // Matches the real `cities` schema (id, state_id, name, city_code, sort_order).
    // The previous list here (state_code/country_code/is_active) named columns
    // that don't exist on this table — active status lives in the shared
    // `flags` table via flag()/isActiveInFlags() instead.
    protected $fillable = ['name', 'state_id', 'city_code', 'sort_order'];

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'like', "%{$term}%");
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function menus()
    {
        // Laravel looks for 'city_menu' table by default
        return $this->belongsToMany(Menu::class);
    }

    /**
     * Relationship to the Flags table (if you want to treat it as a relation)
     * This assumes the 'flags' table has a 'city_id' or matches the City ID.
     */
    public function flag()
    {
        return $this->hasOne(Flag::class, 'id', 'id');
    }

    // Fixed: Your previous method pointed to Menu::class instead of MenuCategory::class
    public function menuCategories()
    {
        return $this->belongsToMany(MenuCategories::class, 'city_menu_category');
    }

    // Rename this method so it doesn't conflict with the attribute
    public function isActiveInFlags()
    {
        return Flag::where('id', $this->id)->where('city', true)->exists();
    }
}
