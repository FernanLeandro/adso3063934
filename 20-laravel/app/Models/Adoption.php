<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'user_id',
        'pet_id'
    ];

        // RelationShips
    // Adoption belongTo user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Adoption belongTo pet
    public function pet() {
    return $this->belongsTo(pet::class);
    }

}

