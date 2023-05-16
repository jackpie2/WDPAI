<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Coffee.php';
require_once __DIR__ . '/../repository/CoffeeRepository.php';

class DefaultController extends AppController
{
    public function login()
    {
        if ($this->isLoggedIn()) {
            $this->render('profile');
        }
        $this->render('login', ['type' => 'login']);
    }

    public function register()
    {
        if ($this->isLoggedIn()) {
            $this->render('profile');
        }
        $this->render('login', ['type' => 'register']);
    }

    public function main()
    {
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page < 1) {
                $page = 1;
            }
        }

        $coffeeRepository = new CoffeeRepository();
        $pageData = $coffeeRepository->getAllCoffee($page);
        $coffeeList = $pageData[0];
        $totalPages = $pageData[1];

        $this->render(
            'main',
            [
                'coffee' => $coffeeList,
                'page' => $page,
                'totalPages' => $totalPages
            ]
        );
    }

    public function product()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (!isset($id)) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
            return;
        }

        $coffeeRepository = new CoffeeRepository();
        $coffee = $coffeeRepository->getCoffee($id);

        if ($coffee == null) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
            return;
        }

        $this->render('product', ['coffee' => $coffee]);
    }

    public function add_product()
    {
        $this->redirectIfNotLoggedIn();
        $this->render('add-product');
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

    public function rate()
    {
        if (!$this->isLoggedIn()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
            return;
        }

        if (!$this->isPost()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
            return;
        }

        $id = $_POST['id'];
        $coffeeRepository = new CoffeeRepository();

        $coffee = $coffeeRepository->getCoffee($id);

        if ($coffee == null) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
            return;
        }

        $rating = $_POST['rating'];
        $userID = $_SESSION['id'];

        $coffeeRepository->rateCoffee($id, $rating, $userID);
    }
}