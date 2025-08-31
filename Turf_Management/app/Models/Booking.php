<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'turf_id',
        'booking_date',
        'start_time',
        'duration_hours',
        'total_amount',
        'notes',
        'status'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'start_time' => 'datetime:H:i',
        'total_amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function turf()
    {
        return $this->belongsTo(Turf::class);
    }

    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'pending' => 'bg-warning',
            'confirmed' => 'bg-success',
            'completed' => 'bg-info',
            'cancelled' => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    public function getEndTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->start_time)->addHours($this->duration_hours);
    }

    public function isUpcoming()
    {
        $now = now();
        $bookingDateTime = \Carbon\Carbon::parse($this->booking_date . ' ' . $this->start_time);
        return $bookingDateTime->isFuture();
    }

    public function isCompleted()
    {
        $now = now();
        $endDateTime = \Carbon\Carbon::parse($this->booking_date . ' ' . $this->start_time)->addHours($this->duration_hours);
        return $endDateTime->isPast();
    }
}
