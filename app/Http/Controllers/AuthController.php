<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller
{

    function __construct()
    {
        $this->middleware('admin')->only('logout','getUser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function index()
    {
        return User::all();
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function customer()
    {
        return User::where('role','=',0)->get();
    }

    public function register(Request $request){
        $fields = $request->validate([
            'name'=>'required|string',
            'lastname'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'village'=>'required|string',
            'district'=>'required|string',
            'province'=>'required|string',
            'password'=>'required|string|confirmed',
        ]);
        

        $user = User::create([
            'name'=>$fields['name'],
            'lastname'=>$fields['lastname'],
            'phone'=>$fields['phone'],
            'email'=>$fields['email'],
            'village'=>$fields['village'],
            'district'=>$fields['district'],
            'province'=>$fields['province'],
            'password'=>bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $fields= $request->validate([
            
            'email'=>'required|string',
            'password'=>'required|string',
        ]);

        //check email
        $user=User::where('email',$fields['email'])->first();

        //check password
        if(!$user || !Hash::check($fields['password'], $user->password)){
            
                return response([
                    'message'=>'bad creds'
                ],401);
            
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token
        ];

        return response($response, 201);
    }

    public function logout(Request $request){

        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
