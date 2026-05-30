<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adult extends Model
{
    public function titles()
    {
        return $this->hasMany(Title::class);
    }

    public function littersAsMother()
    {
        return $this->hasMany(Litter::class, 'mother_id');
    }

    // Se l'adulto è un maschio
    public function littersAsFather()
    {
        return $this->hasMany(Litter::class, 'father_id');
    }
}
