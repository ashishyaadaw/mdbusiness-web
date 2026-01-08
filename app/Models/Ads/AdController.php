<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdController extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'is_premium',
        'status',
        'valid_until',
    ];

    protected $casts = [
        'is_premium' => 'boolean', // This automatically converts true/"true" to 1 and false/"false" to 0
        'valid_until' => 'date',   // Good practice for your date field too
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
