<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function user_login()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userRepository = new UserRepository();
        $user = $userRepository->getUser($_POST['email']);

        if (!$user || $user->getEmail() !== $email || $user->getPassword() !== md5($password)) {
            $this->render('login', ['messages' => ['Wrong email or password. Try again.']]);
            return;
        }

        session_start();

        $_SESSION["user"] = $user->getNickname();
        $_SESSION["email"] = $user->getEmail();
        $_SESSION["role"] = "user";
        $_SESSION["id"] = $user->getId();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");
    }

    public function user_logout()
    {
        session_start();
        session_unset();
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");
    }

    public function user_register()
    {
        if (!$this->isPost()) {
            return $this->render('login', ['type' => 'register']);
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];
        $nickname = $_POST['nickname'];

        if ($password !== $confirmPassword) {
            $this->render('login', ['messages' => ['Passwords are not the same. Try again.'], 'type' => 'register']);
            return;
        }

        // check if the user already exists

        $userRepository = new UserRepository();

        $user = $userRepository->getUser($email);

        if ($user) {
            $this->render('login', ['messages' => ['User with this email already exists. Try again.'], 'type' => 'register']);
            return;
        }

        $newUser = new User($email, $password, $nickname);

        $userRepository->addUser($newUser);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
}
