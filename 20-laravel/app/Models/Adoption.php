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
    return $this->belongsTo(Pet::class);
    }

    // Scopes Names
    public function scopeNames($adopts, $q)
    {
        $q = trim($q);
        if ($q !== '') {
            // search by related user fullname or document
            $adopts->where(function ($query) use ($q) {
                $query->whereHas('user', function ($qUser) use ($q) {
                    $qUser->where('fullname', 'LIKE', "%{$q}%")
                          ->orWhere('document', 'LIKE', "%{$q}%");
                })
                ->orWhereHas('pet', function ($qPet) use ($q) {
                    $qPet->where('name', 'LIKE', "%{$q}%")
                         ->orWhere('breed', 'LIKE', "%{$q}%");
                })
                // fallback: search by ids if numeric
                ->orWhere('user_id', 'LIKE', "%{$q}%")
                ->orWhere('pet_id', 'LIKE', "%{$q}%");
            });
        }
    }

}

