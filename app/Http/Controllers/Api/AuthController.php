<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\ApiLoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(UserLoginRequest $request) {
        if(!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        return $this->ok(
            message: 'Authenticated',
            data: [
                'token' => $user->createToken(
                    'API token for ' . $user->email,
                    ['*'],
                    now()->addMonth()    
                )->plainTextToken
            ]
        );
        // return $this->ok($request->get('email'));
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return $this->ok('');
    }

    public function register() {
        return $this->ok('register');
    }
}
