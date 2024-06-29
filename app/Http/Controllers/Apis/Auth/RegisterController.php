<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Hash;

class RegisterController extends Controller
{
    use GeneralTrait;

    public function __invoke(Request $request)
    {
        $request->validate([
            'name'=>"nullable|max:190",
            // 'username'=>"nullable|max:190|unique:users,username",
            'phone'=>"nullable|max:190|unique:users,phone",
            'email'=>"nullable|unique:users,email",
            'password'=>"required|min:8|max:190"
            // 'bio'=>"nullable|max:5000",
            // 'blocked'=>"required|in:0,1",
        ]);
        $user = User::create([
            "name"=>$request->name,
            "username"=>$request->email,
            "phone"=>$request->phone,
            "bio"=>$request->bio,
            "blocked"=> 0,
            "email"=>$request->email,
            "password"=>\Hash::make($request->password),
        ]);
        return $this -> returnSuccessMessageApi( $user);

        return response()->json(['message' => 'Register']);
    }
}
