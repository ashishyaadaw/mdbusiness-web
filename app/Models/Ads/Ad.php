<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'type', 'payload'];

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

    public function adsDetails()
    {
        return $this->hasOne(AdDetail::class);
    }

    public function adCreator()
    {
        return $this->hasOne(AdCreator::class);
    }

    public function adController()
    {
        return $this->hasOne(AdController::class);
    }
    public function adFeatured()
    {
        return $this->hasOne(AdFeatured::class);
    }
}
