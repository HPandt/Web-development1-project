<?php
class User{
    protected $db;

    public function contruct(){
        $this->db = Database::get();
    }

    public function findByEmail($email){
        $fetchUser = $this->db->prepare("SELECT id, username, email, password_hash,role from users where email = [$email]");
        $fetchUser->execute([$email]);
        return $fetchUser->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username, $email, $password, $roleId=2) : Returntype {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $createUser = $this->db->prepare("INSERT into users (username, email, password, role_id) Values (?,?,?,?)");
        $createUser->execute([$username, $email, $hash_password, $roleId]);
        return $this->db->lastInsertId();
    }
}


