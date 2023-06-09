<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/BrandRepository.php';
require_once __DIR__ . '/../repository/TagRepository.php';

class CoffeeController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';


    private $messages = [];

    public function addProduct()
    {
        if (!$this->isPost()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
            return;
        }

        $this->redirectIfNotLoggedIn();

        if (is_uploaded_file($_FILES['image']['tmp_name']) && $this->validate($_FILES['image'])) {
            $uuid = uniqid();
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $newImageFileName = $uuid . "." . $extension;

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $newImageFileName
            );
        }

        $name = $_POST['name'];
        $description = $_POST['description'];
        $brand = $_POST['brand'];

        if (empty($name) || empty($description) || empty($brand)) {
            $this->render('add-product', ['messages' => ['You have to fill all fields.']]);
            return;
        }

        $tags = explode(" ", $_POST['tags']);

        $brand_id = (new BrandRepository())->getBrandId($brand);

        if ($brand_id == null) {
            $brandRepository = new BrandRepository();
            $brand_id = $brandRepository->addBrand(new Brand($brand));
        }

        $newImageFileName = isset($newImageFileName) ? $newImageFileName : null;

        $coffee = new Coffee($name, $description, $newImageFileName, null, $brand_id, 0);

        $coffeeRepository = new CoffeeRepository();

        $id = $coffeeRepository->addCoffee($coffee);

        if (count($tags) > 0) {
            $tagRepository = new TagRepository();
            $tagRepository->tagCoffee($tags, $id);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/product?id={$id}");
    }

    public function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported.';
            return false;
        }

        return true;
    }

    public function search()
    {
        $name = $_GET['q'];
        $page = $_GET['page'] ?? 1;

        $coffeeRepository = new CoffeeRepository();
        $coffeeList = $coffeeRepository->searchCoffee($name, $page);
        $totalPages = $coffeeList[1];
        $coffeeList = $coffeeList[0];

        header('Content-type: application/json');
        http_response_code(200);
        echo json_encode(
            [
                'coffee' => $coffeeList,
                'page' => $page,
                'totalPages' => $totalPages
            ]
        );
    }

    public function rateProduct()
    {
        if (!$this->isPost()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
            return;
        }

        session_start();

        if (!isset($_SESSION['id'])) {
            http_response_code(401);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['rating']) || !isset($data['coffeeID'])) {
            http_response_code(404);
            return;
        }

        $userID = $_SESSION['id'];
        $rating = $data['rating'];
        $coffeeID = $data['coffeeID'];

        $ratingRepository = new RatingRepository();
        $ratingRepository->rateCoffee($coffeeID, $rating, $userID);

        http_response_code(200);
    }

    public function bookmarkProduct()
    {
        if (!$this->isPost()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/");
            return;
        }

        session_start();

        if (!isset($_SESSION['id'])) {
            http_response_code(401);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['coffeeID'])) {
            http_response_code(404);
            return;
        }

        $userID = $_SESSION['id'];
        $coffeeID = $data['coffeeID'];

        $coffeeRepository = new CoffeeRepository();
        $coffeeRepository->handleBookmark($coffeeID, $userID);

        http_response_code(200);
    }
}
