<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoAd extends Model
{
    protected $fillable = [
        'ad_id',
        'type',
        'title',
        'body',
        'images',
        'action_text',
        'target_url',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
