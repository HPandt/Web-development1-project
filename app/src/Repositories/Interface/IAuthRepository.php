<?php

namespace App\Repositories\Interface;


interface IAuthRepository {
    
    public function findByEmail(string $email);
    public function createUser(string $name, string $email, string $password, int $roleId);
}