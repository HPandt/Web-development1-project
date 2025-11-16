<?php

namespace App\Controllers;

class AuthController
{
    public function loginForm()
    {
        return $this->view('Auth/login.php');        
    }

    public function login(){
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        return $this->redirect('/login?error=invalid');
        
        $userModel = new User();
        $user = $userModel->findByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];

            $db = Database::get();
            $updateLogin = $db->prepare("UPDATE users Set last_login = NOW() Where id = ?");
            $updateLogin->execute([$user['id']]);
            return $this->redirect('');
        }else{
            return $this->redirect('login?error=auth'); 
        }

    }

    public function logout(){
        $_SESSION = [];
        setcookie(session_name(), '', time() - 3600, '/');
        session_destroy();
        return $this->redirect('/login');
    }
}
