<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'category',
        'gender',
    ];

    protected $hidden = [
        'id',
        'ad_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Relationship to the parent Ad.
     */
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    /**
     * Scope to filter ads matching a specific user profile.
     * * Usage: AdDetail::matchesProfile($category, $religion, $caste)->get();
     */
    public function scopeMatchesProfile($query, $category, $religion, $caste)
    {
        return $query->where(function ($q) use ($category) {
            $q->where('category', $category)
                ->orWhereNull('category'); // Match specific OR All
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
