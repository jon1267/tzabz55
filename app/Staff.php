<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $table = 'staff';
    protected $fillable = [
        'position_id', 'name', 'first_name', 'last_name', 'employed_at', 'salary'
    ];
    protected $dates = ['employed_at'];

    public function position() {
        return $this->belongsTo(Position::class);
    }
}
