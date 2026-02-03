<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'country',
        'type_id'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function firstPhoto()
    {
        $firstPhoto = $this->photos()->first();

        if ($firstPhoto) {
            return route('photos.show', $firstPhoto);
        }

        return url('img/no-cover.jpg');
    }

    public function isBookedByUser(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $this->bookings()
            ->where('user_id', $user->id)
            ->exists();
    }

    public function canBeCommentedBy(?User $user): bool
    {
        if (!$user || !$user->hasVerifiedEmail()) {
            return false;
        }

        return $this->bookings()
            ->where('user_id', $user->id)
            ->exists();
    }
}
