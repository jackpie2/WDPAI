<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Brand.php';

class BrandRepository extends Repository
{
    public function getBrand(?int $id): ?Brand
    {
        if ($id == null) {
            return null;
        }

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.brand WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $brand = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($brand == false) {
            return null;
        }

        return new Brand(
            $brand['name']
        );
    }

    public function getBrandId(string $name): ?int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.brand WHERE name = :name
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $brand = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($brand == false) {
            return null;
        }

        return $brand['id'];
    }

    public function addBrand(Brand $brand): int
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO brand (name)
            VALUES (?)
            RETURNING id
        ');

        $stmt->execute([
            $brand->getName()
        ]);

        $brand_id = $stmt->fetch(PDO::FETCH_ASSOC);

        return $brand_id['id'];
    }
}