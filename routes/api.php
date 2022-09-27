<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::resource('products', ProductController::class);

Route::get('/room_types', [RoomTypeController::class, 'index']);
Route::post('/room_types',[RoomTypeController::class,'store']);
Route::put('/room_types/{id}',[RoomTypeController::class,'update']);
Route::delete('/room_types/{id}',[RoomTypeController::class,'destroy']);

Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms',[RoomController::class,'store']);
Route::put('/rooms/{id}',[RoomController::class,'update']);
Route::delete('/rooms/{id}',[RoomController::class,'destroy']);
Route::get('/available_rooms/{date_in}', [BookingController::class, 'available_rooms']);
Route::get('/room/dropdown', [RoomController::class, 'roomDropDown']);

Route::get('/bookings', [BookingController::class, 'index']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::put('/bookings/{id}',[BookingController::class,'update']);
Route::delete('/bookings/{id}',[BookingController::class,'destroy']);

Route::get('/alluser',[AuthController::class,'index']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::put('/editUser/{id}',[AuthController::class,'update']);
Route::delete('/delUser/{id}',[AuthController::class,'destroy']);
Route::get('/customer',[AuthController::class,'customer']);

Route::get('/products',[ProductController::class,'index']);
Route::get('/products/{id}',[ProductController::class,'show']);
Route::get('/products/search/{name}',[ProductController::class,'search']);



Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/products',[ProductController::class,'store']);
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::post('/logout',[AuthController::class,'logout']);

    //booking
    Route::post('/bookings',[BookingController::class,'store']);
    
});




// Route::get('/products',[ProductController::class,'index']);

// Route::post('/products',[ProductController::class,'store']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
