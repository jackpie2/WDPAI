<?php

class AppController
{
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function redirectIfNotLoggedIn()
    {
        if (!$this->isLoggedIn()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        }
    }

    protected function isLoggedIn(): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user']);
    }

    protected function hasRole($role): bool
    {
        if (!$this->isLoggedIn()) {
            return false;
        }

        return $_SESSION['role'] === $role;
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = "public/views/" . $template . '.php';
        $output = 'File not found';


        if (file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }
}
