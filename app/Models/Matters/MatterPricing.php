<?php

namespace App\Models\Matters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatterPricing extends Model
{
    use HasFactory;

    protected $table = "matter_pricing";

    protected $fillable = [
        'matter_id',
        'duration_days',
        'base_amount',
        'discount_amount',
        'processing_fee',
        'gst_amount',
        'total_amount',
        'payment_status',
        'transaction_id',
    ];

    /**
     * Relationship to the parent Matter.
     */
    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }

    /**
     * Scope to filter by payment status.
     * Usage: MatterPricing::paid()->get();
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Accessor to get the total savings formatted.
     */
    public function getFormattedSavingsAttribute()
    {
        return "₹" . number_format($this->discount_amount, 2);
    }
}