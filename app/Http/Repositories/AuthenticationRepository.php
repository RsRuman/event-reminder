<?php

namespace App\Http\Repositories;

use App\Interfaces\AuthenticationInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationRepository implements AuthenticationInterface
{
    /**
     * Register a user
     * @param array $data
     * @return mixed
     */
    public function register(array $data): mixed
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    /**
     * Login a user
     * @param array $credentials
     * @return bool
     */
    public function login(array $credentials): bool
    {
        if (Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }

    /**
     * Logout a user
     * @return null
     */
    public function logout(): null
    {
        return Auth::logout();
    }
}
