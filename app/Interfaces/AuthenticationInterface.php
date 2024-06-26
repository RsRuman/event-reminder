<?php

namespace App\Interfaces;

interface AuthenticationInterface
{
    public function register(array $data);

    public function login(array $credentials);

    public function logout();
}
