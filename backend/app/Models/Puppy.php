<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puppy extends Model
{
    public function litter()
    {
        return $this->belongsTo(Litter::class);
    }
}
