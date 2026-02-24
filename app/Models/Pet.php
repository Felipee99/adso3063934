<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'kind',
        'weight',
        'age',
        'breed',
        'location',
        'description',
        'active',
        'status'
    ];

    // RelationShips
    //User hasOne Adoptions
    public function adoptions()
    {
        return $this->hasOne(Adoption::class);
    }

    public function scopenames($pets, $q)
    {
        if (trim($q)) {
            $pets->where('name', 'LIKE', "%$q%")->orWhere('kind', 'LIKE', "%$q%");
        }
    }   
      public function scopekinds($pets, $q)
    {
        if (trim($q)) {
            $pets->where('name', 'LIKE', "%$q%")
            ->where('status', 0)
            ->orWhere('kind', 'LIKE', "%$q%")
            ->where('status', 0);
        }
    }   
}
