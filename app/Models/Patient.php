<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'date_of_birth',
        'owner_id',
        
         //'notes',   // si lo usas
    ];
    public function owner():BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }
    public function treatments():hasmany
    {
        return $this->hasmany(Treatment::class);
    }
}
