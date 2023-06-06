<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Coffee.php';
require_once __DIR__ . '/../models/Brand.php';

class CoffeeRepository extends Repository
{
    public function getCoffee(int $id): ?Coffee
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.coffee_view WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $coffee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($coffee == false) {
            return null;
        }

        return new Coffee(
            $coffee['name'],
            $coffee['description'],
            $coffee['image_file'],
            $coffee['rating'],
            $coffee['brand'],
            $coffee['review_count']
        );
    }

    public function getAllCoffee(int $page): ?array
    {
        $result = [];

        $itemsPerPage = 10;

        $page = $page - 1;

        if ($page < 0) {
            $page = 0;
        }

        $stmt = $this->database->connect()->prepare('
            SELECT *, count(*) OVER() as total_pages FROM public.coffee_view
            ORDER BY id
            LIMIT :itemsPerPage
            OFFSET :page
        ');
        $stmt->bindParam(':page', $page, PDO::PARAM_INT);
        $stmt->bindParam(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        $coffee = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($coffee == false) {
            return null;
        }

        $total_pages = $coffee[0]['total_pages'];
        $total_pages = ceil($total_pages / $itemsPerPage);

        foreach ($coffee as $single_coffee) {
            $result[] = new Coffee(
                $single_coffee['name'],
                $single_coffee['description'],
                $single_coffee['image_file'],
                $single_coffee['rating'],
                $single_coffee['brand'],
                $single_coffee['review_count'],
                $single_coffee['id']
            );
        }

        return array($result, $total_pages);
    }

    public function rateCoffee(int $id, int $rating, int $userID): void
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.rating (rated_coffee, grade, rated_by)
            VALUES (:id, :rating, :userID)
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function addCoffee(Coffee $coffee): int
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.coffee (name, description, image_file, brand)
            VALUES (:name, :description, :image_file, :brand)
            RETURNING id
        ');
        
        $stmt->bindParam(':name', $coffee->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':description', $coffee->getDescription(), PDO::PARAM_STR);
        $stmt->bindParam(':image_file', $coffee->getimage_file(), PDO::PARAM_STR);
        $stmt->bindParam(':brand', $coffee->getBrand(), PDO::PARAM_STR);
        
        $stmt->execute();

        $id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

        return $id;
    }
}