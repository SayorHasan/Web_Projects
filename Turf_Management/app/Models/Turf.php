<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turf extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sport_type',
        'price_per_hour',
        'image_path',
        'features',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
        'price_per_hour' => 'decimal:2'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    public function isAvailable()
    {
        return $this->status === 'available';
    }

    // Return sports as array (supports comma-separated storage)
    public function getSportListAttribute(): array
    {
        if (is_array($this->sport_type)) {
            return $this->sport_type;
        }
        $raw = (string) $this->sport_type;
        if ($raw === '') {
            return [];
        }
        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    // Primary sport (first in the list)
    public function getPrimarySportAttribute(): ?string
    {
        return $this->sport_list[0] ?? null;
    }

    // Display string like "Football, Cricket"
    public function getSportDisplayAttribute(): string
    {
        $list = $this->sport_list;
        if (empty($list)) {
            return '';
        }
        return implode(', ', array_map(fn($s) => ucfirst($s), $list));
    }

    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'available' => 'bg-success',
            'maintenance' => 'bg-warning',
            'booked' => 'bg-danger',
            default => 'bg-secondary'
        };
    }
}
