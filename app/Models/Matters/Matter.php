<?php

namespace App\Models\Matters;

use App\Models\CityMenuMatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'menu_id', 'title', 'type', 'payload'];

    protected $hidden = ['created_at', 'updated_at'];

    // Accessor: Automatically generates the full URL for the image
    public function getPayloadAttribute($value)
    {
        if ($this->type === 'image') {
            // Generates http://your-domain.com/uploads/ads/filename.jpg
            return asset($value);
        }

        return $value;
    }

    public function matterDetails()
    {
        return $this->hasOne(MatterDetail::class);
    }

    public function matterController()
    {
        return $this->hasOne(MatterController::class);
    }

    // In App\Models\Matter.php
    public function cityMenuMatters()
    {
        // This connects the Matter to the pivot table entries
        return $this->hasMany(CityMenuMatter::class, 'matter_id');
    }
}
