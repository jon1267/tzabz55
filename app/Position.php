<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function staff() {
        return $this->hasMany(Staff::class);
    }
}
