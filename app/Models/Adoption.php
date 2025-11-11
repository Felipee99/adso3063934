<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adoption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'pet_id',
    ];

        // RelationShips
        //adoption belong User
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        //adoption belong Pet
        public function pet()
        {
            return $this->belongsTo(Pet::class);
        }
}