<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'full_name',
        'cpf',
        'email',
        'phone',
        'birth_date',
        'gender',
        'shirt_size',
        'zip_code',
        'address',
        'number',
        'neighborhood',
        'city',
        'state',
        'country',
        'has_kit',
        'terms_accepted',
        'accepted_regulations',
        'is_active',
        'kit_delivered_at',
        'food_kg',
        'food_liters',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'has_kit' => 'boolean',
        'terms_accepted' => 'boolean',
        'accepted_regulations' => 'boolean',
        'is_active' => 'boolean',
        'kit_delivered_at' => 'datetime',
        'food_kg' => 'decimal:2',
        'food_liters' => 'decimal:2',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getFormattedCpfAttribute()
    {
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->cpf);
    }

    public function getFormattedZipCodeAttribute()
    {
        return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $this->zip_code);
    }

    public function getAgeAttribute()
    {
        return $this->birth_date->age;
    }
}
