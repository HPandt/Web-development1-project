<?php

namespace App\Controllers;


use App\Core\Repository;
use App\Repositories\AuthRepository;
use App\Services\AuthService;
use App\Models\UserModel;

class AuthController
{
    
    private AuthService $authService;
    public function __construct()
    {
        $db = new Repository();
        $this->authService = new AuthService(new AuthRepository());
    }

    public function loginForm()
    {
        // load the Auth login view
        require(__DIR__ . '/../Views/Auth/login.php');      
    }

    public function login(){
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)){
            $error = "Invalid email or password";
            require(__DIR__ . '/../Views/Auth/login.php');
            return;
        }

        $user = $this->authService->login($email, $password);
        if($user){
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
        $password = $_POST['password'] ?? '';

        if(empty($username) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6){
            $error = "Please provide valid registration details.";
            require(__DIR__ . '/../Views/Auth/register.php');
            return;
        }

        $this->authService->createUser(
            $username,
            $email,
            $password,
            1 
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
