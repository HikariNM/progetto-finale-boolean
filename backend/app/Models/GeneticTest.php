<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneticTest extends Model
{
    public function adult()
    {
        return $this->belongsToMany(Adult::class, 'adult_genetic_test')
            ->withPivot('test_date', 'result');
    }
}
