<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'vacation_id'];

    public function vacation()
    {
        return $this->belongsTo(Vacation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
