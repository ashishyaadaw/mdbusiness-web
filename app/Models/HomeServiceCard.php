<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeServiceCard extends Model
{
    protected $fillable = [
        'eyebrow',
        'title',
        'subtitle',
        'image_path',
        'bg_class',
        'button_text',
        'button_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): ?string
    {
        if (blank($this->image_path)) {
            return null;
        }

        return str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')
            ? $this->image_path
            : asset($this->image_path);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
