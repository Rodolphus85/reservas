<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = ['location_id', 'number', 'guest_count'];
    
    public function location() 
    {
        return $this->belongsTo(Location::class);
    }
}
