<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';

class SecurityController extends AppController
{
    public function user_login()
    {
        $user = new User('test@email.com', 'admin', 'test');

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->getEmail() !== $email || $user->getPassword() !== md5($password)) {
            $this->render('login', ['messages' => ['Wrong email or password. Try again.']]);
            return;
        }

        session_start();

        $_SESSION["user"] = $user->getNickname();
        $_SESSION["email"] = $user->getEmail();
        $_SESSION["role"] = "user";

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");
    }

    public function user_logout()
    {
        session_start();
        session_unset();
        session_destroy();

        $this->render('main');
    }
}
