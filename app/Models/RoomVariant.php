<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomVariant extends Model
{
    use HasFactory;
    protected $fillable=[
        'room_type_id',
        'status',
        'room_number'
    ];

    public function room_types(){
        return $this->hasMany(RoomType::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

}
