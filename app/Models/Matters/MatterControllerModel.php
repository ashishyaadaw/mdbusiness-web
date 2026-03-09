<?php

namespace App\Models\Matters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatterControllerModel extends Model
{
    use HasFactory;

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
