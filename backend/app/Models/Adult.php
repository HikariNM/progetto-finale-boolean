<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adult extends Model
{
    public function titles()
    {
        return $this->hasMany(Title::class);
    }
}
