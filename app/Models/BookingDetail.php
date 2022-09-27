<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    public function booking_statuse()
    {
       return $this->belongsTo(BookingStatus::class);
    }
    public function booking()
    {
       return $this->belongsTo(Booking::class);
    }
}
