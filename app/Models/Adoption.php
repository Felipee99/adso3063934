<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pet_id',
    ];

    // ---------------------------
    // 🔗 Relaciones
    // ---------------------------

    // Una adopción pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Una adopción pertenece a una mascota
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    // ---------------------------
    // 🔍 Scope para búsqueda
    // ---------------------------
    public function scopeNames($query, $q)
    {
        if (trim($q)) {
            $query
                ->whereHas('user', function ($sub) use ($q) {
                    $sub->where('fullname', 'LIKE', "%$q%");
                })
                ->orWhereHas('pet', function ($sub) use ($q) {
                    $sub->where('name', 'LIKE', "%$q%");
                });
        }
    }
}
