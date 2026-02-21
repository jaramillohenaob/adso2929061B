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

    //Relationships
    // Adoption belongs to user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Adoption belongs to pet
    public function pet(){
        return $this->belongsTo(Pet::class);
    }

}
