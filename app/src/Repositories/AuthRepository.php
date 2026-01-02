<?php

namespace App\Repositories;

use App\Core\Repository;
use App\Repositories\Interface\IAuthRepository;
use App\Models\UserModel;
use PDO;

class AuthRepository extends Repository implements IAuthRepository {
    
    public function findByEmail(string $email): ?UserModel{
        $sql = "SELECT id, username, email, password_hash, role from users where email = :email";
        $fetchUser = $this->getConnection()->prepare($sql);
        $fetchUser->execute(['email' => $email]);
        $user = $fetchUser->fetch(PDO::FETCH_ASSOC);
        
        if(!$user){
            return null;
        }

        return new UserModel(
            $user['id'],
            $user['username'],
            $user['email'],
            $user['password_hash'],
            $user['role']
        );
    }

    public function createUser(string $username, string $email, string $password, int $roleId=2) {
        $sql = "INSERT INTO users (username, email, password_hash, role) VALUES (:username, :email, :password_hash, :role)";
        $createUser = $this->getConnection()->prepare($sql);
        $createUser->execute([
            'username' => $username,
            'email' => $email,
            'password_hash' => $password,
            'role' => $roleId
        ]);
        return $this->getConnection()->lastInsertId();
    }
}





