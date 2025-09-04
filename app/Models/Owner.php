<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Panel\Concerns\HasFavicon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;




class Owner extends Model
{
    use HasFactory;
     // <-- Aquí declaramos los campos permitidos
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }
}
