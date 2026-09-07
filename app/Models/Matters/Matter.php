<?php

namespace App\Models\Matters;

use App\Models\CityMenu;
use App\Models\CityMenuMatter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
/**
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $payload
 * @property int $user_id
 */
class Matter extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',  'title', 'type', 'payload','sort_order'];

    // protected $hidden = ['created_at', 'updated_at'];

    // Accessor: Automatically generates the full URL(s) for the image.
    // A type=image payload may hold a single stored path, or several
    // comma-separated paths for a multi-image post — each segment is
    // resolved to a full URL individually and rejoined with commas, so
    // calling asset() on the whole string never mangles the later URLs.
    public function getPayloadAttribute($value)
    {
        if ($this->type === 'image' && filled($value)) {
            return collect(explode(',', $value))
                ->map(fn ($path) => trim($path))
                ->filter()
                ->map(fn ($path) => Str::startsWith($path, ['http://', 'https://']) ? $path : asset($path))
                ->implode(',');
        }

        return $value;
    }

    /**
     * The image URLs for a type=image matter, split out of the
     * comma-separated payload. Empty for type=text matters.
     */
    public function getImageUrlsAttribute(): array
    {
        if ($this->type !== 'image' || blank($this->payload)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $this->payload))));
    }

    /**
     * Same segments as image_urls, but the raw stored paths (not asset()
     * URLs) — needed wherever the payload is being edited/rewritten, since
     * re-saving a full URL would get double-prefixed on the next read.
     */
    public function getRawImagePathsAttribute(): array
    {
        $raw = $this->getRawOriginal('payload');

        if ($this->type !== 'image' || blank($raw)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    public function matterCreator()
    {
        // Explicit FK: Eloquent would otherwise infer 'matter_creator_id'
        // from the relation name, which doesn't exist on this table.
        return $this->belongsTo(User::class, 'user_id');
    }

    public function matterDetails()
    {
        return $this->hasOne(MatterDetail::class);
    }

    public function matterController()
    {
        return $this->hasOne(MatterController::class);
    }

    // Inside Matter.php
    public function matterPricing()
    {
        return $this->hasOne(MatterPricing::class);
    }

    public function details()
    {
        return $this->hasOne(MatterDetail::class);
    }

    public function controller()
    {
        return $this->hasOne(MatterController::class);
    }

    // In App\Models\Matter.php
    public function cityMenuMatter()
    {
        // This connects the Matter to the pivot table entries
        return $this->hasMany(CityMenuMatter::class, 'matter_id', 'id');
    }

    public function cityMenus()
    {
        // This connects the Matter to CityMenu through the pivot table
        return $this->belongsToMany(CityMenu::class, 'city_menu_matter', 'matter_id', 'city_menu_id');
    }

    
}