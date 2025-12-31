<?php

namespace App\Repositories\Interface;

use Apps\Models\UserModel; 

interface IAdminRepository {
    public function findByEmail($email);
    public function createUser($name, $email, $password, $roleId);
}