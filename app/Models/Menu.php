<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'icon', 'status', 'type'];

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