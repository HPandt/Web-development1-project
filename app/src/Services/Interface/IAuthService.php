<?php

namespace App\Services\Interface;


interface IAuthService {
    
    public function login( string $email, string $password);
    public function createUser(string $name, string $email, string $password, int $roleId);
}