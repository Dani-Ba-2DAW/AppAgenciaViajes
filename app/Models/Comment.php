<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'vacation_id', 'text'];

    public function vacation()
    {
        return $this->belongsTo(Vacation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function canBeDeletedBy(User $user): bool
    {
        if ($user->rol === 'admin' || $user->rol === 'advanced') {
            return true;
        }

        return $this->user_id === $user->id;
    }
}
