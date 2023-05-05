<?php

require_once 'AppController.php';


class DefaultController extends AppController
{
    public function login()
    {
        if ($this->isLoggedIn()) {
            $this->render('profile');
        }
        $this->render('login');
    }

    public function main()
    {
        $this->render('main');
    }

    public function product()
    {
        $this->render('product');
    }

    public function profile()
    {
        $this->redirectIfNotLoggedIn();
        $this->render('profile');
    }

    public function saved()
    {
        $this->redirectIfNotLoggedIn();
        $this->render('saved-products');
    }
}
