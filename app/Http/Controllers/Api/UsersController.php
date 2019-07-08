<?php

namespace App\Http\Controllers\Api;

use http\Client\Curl\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
       return response()->json([
            'success'=>true,
           'message'=>'',
           'data'=>User::all()
       ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //validation
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:6|max:13|unique:users,phone_number',
            'photo' => 'required|image|max:10240',
            'password' => 'required|min:6|confirmed',
        ]);

        $validator=Validator::make($request->all(),$this);
        if ($validator->fails()){
            return response()->json($validator->getMesssage()->all());
        }

        $photo = $request->file('photo');
        $file_name = uniqid('photo_', true) . str_random(10) . '.' . $photo->getClientOriginalExtension();
        if ($photo->isValid()) {
            $photo->storeAs('images', $file_name);
        }
        $user = User::create([
            'full_name' => $request->input('full_name'),
            'email' => strtolower($request->input('email')),
            'phone_number' => $request->input('phone_number'),
            'photo' => $request->input('photo', $file_name),
            'password' => bcrypt($request->input('password')),
            'email_verification_token' => str_random(32)
        ]);

        $user->notify(new VerifyEmail($user));
        return response()->json(['message'=>'Account Created']);
    }
}
