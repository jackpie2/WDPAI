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
}
