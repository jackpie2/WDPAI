<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Coffee.php';
require_once __DIR__ . '/../repository/CoffeeRepository.php';
require_once __DIR__ . '/../repository/RatingRepository.php';

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
        $this->isLoggedIn();

        $this->render(
            'main'
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

        if ($this->isLoggedIn()) {
            $ratingRepository = new RatingRepository();
            $userRating = $ratingRepository->getUserRating($id, $_SESSION['id']);
            $isBookmarked = $coffeeRepository->isBookmarked($id, $_SESSION['id']);
            $this->render('product', ['coffee' => $coffee, 'userRating' => $userRating, 'loggedIn' => true, 'isBookmarked' => $isBookmarked]);
            return;
        }

        $this->render('product', ['coffee' => $coffee, 'userRating' => null, 'loggedIn' => false, 'isBookmarked' => null]);
    }

    public function add_product()
    {
        $this->redirectIfNotLoggedIn();
        if ($this->hasRole(2)) {
            $this->render('add-product');
        } else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
        }
    }

    public function profile()
    {
        $this->redirectIfNotLoggedIn();

        $ratingRepository = new RatingRepository();
        $ratedProducts = $ratingRepository->getUserRatingCount($_SESSION['id']);

        $this->render('profile', ['ratedProducts' => $ratedProducts]);
    }

    public function saved()
    {
        $this->redirectIfNotLoggedIn();

        $coffeeRepository = new CoffeeRepository();
        $savedProducts = $coffeeRepository->getBookmarks($_SESSION['id']);

        $this->render('saved-products', ['savedProducts' => $savedProducts]);
    }
}
