<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Litter extends Model
{
    public function puppies()
    {
        return $this->hasMany(Puppy::class);
    }
}
