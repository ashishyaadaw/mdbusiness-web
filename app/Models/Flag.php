<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * * @var string
     */
    protected $table = 'flags'; // Change this if your table name is different

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', // Assuming you want to set this manually, otherwise remove it from fillable
        'city',
        'menus',
        'menu_category',
        'city_menu',
        'city_menu_matter',
        'matter',
    ];

    /**
     * The attributes that should be cast.
     * This turns tinyint(1) into boolean (true/false) automatically.
     *
     * @var array
     */
    protected $casts = [
        'city' => 'boolean',
        'menu' => 'boolean',
        'menu_category' => 'boolean',
        'city_menu' => 'boolean',
        'city_menu_matter' => 'boolean',
        'matter' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}