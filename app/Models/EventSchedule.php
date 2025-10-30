<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    protected $table = 'event_schedule';
    
    protected $fillable = [
        'time',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'time' => 'datetime:H:i',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('time', 'asc');
    }

    // Accessor para formatar o horário
    public function getFormattedTimeAttribute()
    {
        return $this->time->format('H:i');
    }
}
