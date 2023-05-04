<?php

require_once 'AppController.php';


class DefaultController extends AppController
{
    public function login()
    {
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
        $this->render('profile');
    }
}
