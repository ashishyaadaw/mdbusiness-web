<?php

namespace App\Models\Matters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatterController extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($matterController) {
            // If valid_until isn't manually set, default to 10 days from now
            if (empty($matterController->valid_until)) {
                $matterController->valid_until = now()->addDays(10);
            }
        });
    }

    protected $fillable = [
        'matter_id',
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

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }
}
