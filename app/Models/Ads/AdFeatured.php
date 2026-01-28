<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdFeatured extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'full_name',
        'dob',
        'occupation',
        'category',
        'json_data',
        'bio',
        'profile_photo',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
