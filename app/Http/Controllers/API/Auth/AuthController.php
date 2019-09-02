<?php

namespace App\Http\Controllers\API\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Dealer;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()], 422);
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->get('password'));
        try {
            $user = User::create($input);
            $dealer['name']    = $user['name'];
            $dealer['login']    = $user['email'];
            $dealer['email']    = $user['email'];
            $dealer['password'] = $user['password'];
            Dealer::updateOrCreate([
                'name'     => $dealer['name'],
                'login'    => $dealer['login'],
                'email'    => $dealer['email'],
                'password' => $dealer['password'],
                ]);
        } catch (QueryException $e) {
            return response()->json(['message' => $e, 'success' => false],409);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th, 'success' => false],500);
        }
        
        $token =  $user->createToken('patitoapp')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token =  $user->createToken('patitoapp')->accessToken;
            return response()->json([
                'token' => $token,
                'user' => $user
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }


}
