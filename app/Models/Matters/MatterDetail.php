<?php

namespace App\Models\Matters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatterDetail extends Model
{
    use HasFactory;
    protected $table = "matter_detail";

    protected $fillable = [
        'matter_id',
        'phone',
        'website',
    ];

    // protected $hidden = [
    //     'id',
    //     'matter_id',
    //     'created_at',
    //     'updated_at',
    // ];

    /**
     * Relationship to the parent Matter.
     */
    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }

    /**
     * Scope to filter ads matching a specific user profile.
     * * Usage: AdDetail::matchesProfile($category, $religion, $caste)->get();
     */
    public function scopeMatchesProfile($query, $phone, $religion, $caste)
    {
        return $query->where(function ($q) use ($phone) {
            $q->where('phone', $phone)
                ->orWhereNull('phone'); // Match specific OR All
        })
            ->where(function ($q) use ($religion) {
                $q->where('religion', $religion)
                    ->orWhereNull('religion'); // Match specific OR All
            })
            ->where(function ($q) use ($caste) {
                $q->where('caste', $caste)
                    ->orWhereNull('caste'); // Match specific OR All
            });
    }
}
