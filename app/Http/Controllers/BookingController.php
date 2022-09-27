<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Booking::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'room_id'=>'required',
            'user_id'=>'required',
            'date_in'=>'required',
            'date_out'=>'required',
            'adults'=>'required',
            'children'=>'nullable',
            'tel'=>'required',
        ]);
        return Booking::create($request->all());

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    // {
    //     return Booking::where('user_id','=',$user_id)->get();
    // }
    {
        $history = DB::table('bookings')
            ->join('rooms', 'rooms.id', '=', 'bookings.room_id')
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('users.name as username', 'rooms.name', 'bookings.date_in', 'bookings.date_out', 'bookings.adults', 'bookings.children', 'room_types.price')
           // ->select('rooms.*', 'users.*', 'bookings.*')
            ->where('user_id','=',$user_id)->get();
            return response()->json(['data'=>$history]);
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        $booking->update($request->all());
        return $booking;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Booking::destroy($id);
    }

    

    // Check Avaiable rooms
    function available_rooms(Request $request,$date_in){
        $arooms = DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE '$date_in' BETWEEN date_in AND date_out)");

        // $data=[];
        // foreach($arooms as $room){
        //     $roomTypes=RoomType::find($room->room_type_id);
        //     $data[]=['room'=>$room,'roomtype'=>$roomTypes];
        // }

        return response()->json(['data'=>$arooms]);
    }
}
