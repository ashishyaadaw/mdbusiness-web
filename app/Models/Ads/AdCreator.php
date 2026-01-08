<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdCreator extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'name',
        'contact',
        'alternate_contact',
        'whatsapp',
        'email',
    ];

    protected $hidden = [
        'id',
        'ad_id',
        'created_at',
        'updated_at',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
