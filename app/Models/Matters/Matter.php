<?php

namespace App\Models\Matters;

use App\Models\CityMenu;
use App\Models\CityMenuMatter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $payload
 * @property int $user_id
 */
class Matter extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',  'title', 'type', 'payload'];

    // protected $hidden = ['created_at', 'updated_at'];

    // Accessor: Automatically generates the full URL for the image
    public function getPayloadAttribute($value)
    {
        if ($this->type === 'image') {
            // Generates http://your-domain.com/uploads/ads/filename.jpg
            return asset($value);
        }

        return $value;
    }

    public function matterCreator()
    {
        return $this->belongsTo(User::class);
    }

    public function matterDetails()
    {
        return $this->hasOne(MatterDetail::class);
    }

    public function matterController()
    {
        return $this->hasOne(MatterController::class);
    }

    // Inside Matter.php
    public function matterPricing()
    {
        return $this->hasOne(MatterPricing::class);
    }

    public function details()
    {
        return $this->hasOne(MatterDetail::class);
    }

    public function controller()
    {
        return $this->hasOne(MatterController::class);
    }

    // In App\Models\Matter.php
    public function cityMenuMatter()
    {
        // This connects the Matter to the pivot table entries
        return $this->hasMany(CityMenuMatter::class, 'matter_id', 'id');
    }

    public function cityMenus()
    {
        // This connects the Matter to CityMenu through the pivot table
        return $this->belongsToMany(CityMenu::class, 'city_menu_matter', 'matter_id', 'city_menu_id');
    }

    
}