<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caste extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'religion_id'];

    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class);
    }

    public function subCastes(): HasMany
    {
        return $this->hasMany(SubCaste::class);
    }
}
