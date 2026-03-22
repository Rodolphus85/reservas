<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function tables()
    {
        return $this->belongsToMany(Table::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}