<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'reservation_date', 'start_time', 'end_time', 'guest_count'];
    
    public function tables()
    {
        return $this->belongsToMany(Table::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}