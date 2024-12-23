<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // relasi ke kursi
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    //relasi ke showtime
    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
