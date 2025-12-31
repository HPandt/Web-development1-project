<?php

namespace App\Controllers;


use App\Core\Repository;
use App\Repositories\AuthRepository;
use App\Models\UserModel;
use User;

class AuthController
{
    private AuthRepository $authRepository;

    public function __construct()
    {
        session_start();
        $this->authRepository = new AuthRepository();
    }

    public function loginForm()
    {
        // load the Auth login view
        require(__DIR__ . '/../Views/Auth/login.php');      
    }

    public function login(){
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password_hash'] ?? '';

        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)){
            require(__DIR__ . '/../Views/Auth/login.php');
            return;
        }

        $user = $this->authRepository->findByEmail($email);

        if($user && password_verify($password, $user->password_hash)){
            // Successful login
            $_SESSION['user_id'] = $user->id;
            $_SESSION['role'] = $user->role;

            // Redirect by role
        if ($user->role === 'admin') {
            header('Location: /admin/dashboard');
        } else {
            header('Location: /game');
        }
            exit();
        }else{
            return require(__DIR__ . '/../Views/Auth/login.php');
        }

    }

    public function registerForm()
    {
        // load the Auth register view
        require(__DIR__ . '/../Views/Auth/register.php');      
    }

    public function register(){
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password_hash'] ?? '';

        if(empty($username) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6){
            return require(__DIR__ . '/../Views/Auth/register.php');
        }

        $this->authRepository->createUser(
            $username,
            $email,
            $password,
            'player'
        );

        header('Location: /login');
        exit();
    }

    public function logout(){
        $_SESSION = [];
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');
        header('Location: /login');
       
        exit();
    }
}
