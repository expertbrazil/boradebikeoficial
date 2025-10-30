<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'city',
        'state',
        'about_text',
        'kit_description',
        'kit_limit',
        'schedule',
        'safety_info',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_active' => 'boolean',
        'kit_limit' => 'integer',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function getActiveEvent()
    {
        return $this->where('is_active', true)->first();
    }

    public function getRemainingKits()
    {
        $usedKits = $this->registrations()->where('has_kit', true)->count();
        return max(0, $this->kit_limit - $usedKits);
    }
}

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'city',
        'state',
        'about_text',
        'kit_description',
        'kit_limit',
        'schedule',
        'safety_info',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_active' => 'boolean',
        'kit_limit' => 'integer',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function getActiveEvent()
    {
        return $this->where('is_active', true)->first();
    }

    public function getRemainingKits()
    {
        $usedKits = $this->registrations()->where('has_kit', true)->count();
        return max(0, $this->kit_limit - $usedKits);
    }
}
