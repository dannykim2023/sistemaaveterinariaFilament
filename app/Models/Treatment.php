<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Treatment extends Model
{
    use HasFactory;

    
    protected $casts = [
        'price' => MoneyCast::class,
    ];

    protected $fillable = [
        'description',
        'notes',
        'price',
        'patient_id',
    ];

    // Relación con Patient (Paciente)
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}