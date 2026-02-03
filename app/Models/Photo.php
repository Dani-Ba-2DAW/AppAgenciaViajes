<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['vacation_id', 'route'];

    public function vacation()
    {
        return $this->belongsTo(Vacation::class);
    }
}
