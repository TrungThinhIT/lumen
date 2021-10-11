<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Entities\User
     */
    protected function create(array $data)
    {
        return User::create([
            'id' => $data['id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'phone' => $data['phone'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->create($request->all());
        $token = $user->createToken('lumen')->accessToken;
        $user->setAttribute('token', $token);
        return $this->respondCreated($user);
    }
}
