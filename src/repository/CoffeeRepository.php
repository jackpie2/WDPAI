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

        if (!$coffee) {
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

        $itemsPerPage = 5;

        $page = $page - 1;

        if ($page < 0) {
            $page = 0;
        }

        $stmt = $this->database->connect()->prepare('
            SELECT *, count(*) OVER() as total_pages FROM public.coffee_view
            ORDER BY id
            LIMIT :itemsPerPage
            OFFSET :offset
        ');
        $offset = $page * $itemsPerPage;

        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
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

    public function searchCoffee(string $search, int $page): ?array
    {
        $page = $page - 1;

        $stmt = $this->database->connect()->prepare('
            SELECT public.coffee_view.*, public.brand.name brand_name, count(*) OVER() AS total_pages FROM public.coffee_view
            left join public.brand 
            on brand.id = public.coffee_view.brand where LOWER(public.coffee_view.name) LIKE LOWER(:search)
            OR LOWER(public.brand.name) LIKE LOWER(:search)
            ORDER BY id
            LIMIT 5
            OFFSET :offset
        ');

        $search = '%' . $search . '%';
        $offset = $page * 5;

        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $coffee = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total_pages = ceil($coffee[0]['total_pages'] / 5);

        return [$coffee, $total_pages];
    }

    public function handleBookmark(int $coffee_id, int $user_id): void
    {
        if ($this->isBookmarked($coffee_id, $user_id)) {
            $this->removeBookmark($coffee_id, $user_id);
        } else {
            $this->addBookmark($coffee_id, $user_id);
        }
    }

    public function removeBookmark(int $coffee_id, int $user_id): void
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM public.bookmarks
            WHERE user_id = :user_id AND coffee_id = :coffee_id
        ');

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':coffee_id', $coffee_id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function addBookmark(int $coffee_id, int $user_id): void
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.bookmarks (user_id, coffee_id)
            VALUES (:user_id, :coffee_id)
        ');

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':coffee_id', $coffee_id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function isBookmarked(int $coffee_id, int $user_id): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.bookmarks
            WHERE user_id = :user_id AND coffee_id = :coffee_id
        ');

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':coffee_id', $coffee_id, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result == false) {
            return false;
        }

        return true;
    }

    public function getBookmarks(int $user_id): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT public.coffee_view.*, public.brand.name brand_name FROM public.coffee_view
            left join public.brand 
            on brand.id = public.coffee_view.brand
            WHERE public.coffee_view.id IN (
                SELECT coffee_id FROM public.bookmarks
                WHERE user_id = :user_id
            )
        ');

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();

        $coffee = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($coffee == false) {
            return null;
        }

        $result = [];

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

        return $result;
    }
}
