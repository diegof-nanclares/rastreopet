<?php

namespace Controllers;

use Models\User\UserModel;

/**
 * Class AuthController
 * @package Controllers
 */
class AuthController
{

    public const ADMIN = 1;
    public const STANDARD_USER = 2;

    public function authUser()
    {
        if(!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
            if($_SESSION['role'] === self::ADMIN) {
                header("Location: /dashboard");
                return;
            }

            header("Location: /userdashboard");

        }

        $user = $_POST['user'] ?? null;
        $password = $_POST['password'] ?? null;
        $authenticated = false;

       if($user && $password) {
           $userModel = new UserModel();

           $authenticated = $userModel->getUserAuth($user, $password);
       }

        if(is_array($authenticated) && $authenticated['authenticated']) {
            if($authenticated['user']['user_role'] == self::ADMIN) {
                header("Location: /dashboard");
                return;
            }

            header("Location: /userdashboard");
            return;
        } else {
            $message = $user || $password ? "Email o contraseña incorrectos, verifique e intentelo nuevamente" : '';
            require_once __DIR__ . '/../Views/login.php';
        }
    }

    public function isLoggedIn() {
        return  !empty($_SESSION['username']) && !empty($_SESSION['password']);
    }

    public function closeSession() {
        header("Location: /home");
    }
}
