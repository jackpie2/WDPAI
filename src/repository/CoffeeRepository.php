<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Coffee.php';

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
            $coffee['id'],
            $coffee['name'],
            $coffee['description'],
            $coffee['image_uuid'],
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
                $single_coffee['id'],
                $single_coffee['name'],
                $single_coffee['description'],
                $single_coffee['image_uuid'],
                $single_coffee['rating'],
                $single_coffee['brand'],
                $single_coffee['review_count']
            );
        }

        return array($result, $total_pages);
    }
}
