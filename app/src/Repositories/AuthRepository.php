<?php

namespace App\Repositories;

use App\Core\Repository;
use App\Repositories\Interface\IAuthRepository;
use App\Models\UserModel;
use PDO;

class AuthRepository extends Repository implements IAuthRepository {
    
    public function findByEmail(string $email){
        $fetchUser = $this->getConnection()->prepare("SELECT id, username, email, password_hash, role from users where email = :email");
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

    public function createUser($username, $email, $password, $roleId=2) {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password_hash, role) VALUES (:username, :email, :password_hash, :role)";
        $createUser = $this->getConnection()->prepare($sql);
        $createUser->execute([
            'username' => $username,
            'email' => $email,
            'password_hash' => $hash_password,
            'role' => $roleId
        ]);
        return $this->getConnection()->lastInsertId();
    }
}





