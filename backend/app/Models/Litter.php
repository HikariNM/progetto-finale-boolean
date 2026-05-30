<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Litter extends Model
{
    public function puppies()
    {
        return $this->hasMany(Puppy::class);
    }

    public function mother()
    {
        return $this->belongsTo(Adult::class, 'mother_id');
    }

    public function father()
    {
        return $this->belongsTo(Adult::class, 'father_id');
    }
}
