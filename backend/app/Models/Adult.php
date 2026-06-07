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

    public function littersAsFather()
    {
        return $this->hasMany(Litter::class, 'father_id');
    }
    public function geneticTests()
    {
        return $this->belongsToMany(GeneticTest::class, 'adult_genetic_test')
            ->withPivot('test_date', 'result');
    }
}
