<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Coffee.php';
require_once __DIR__ . '/../models/Brand.php';

class RatingRepository extends Repository
{
    public function rateCoffee(int $id, int $rating, int $userID): void
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.rating WHERE rated_coffee = :id AND rated_by = :userID
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result != false) {
            if ($result['grade'] == $rating) {
                $stmt = $this->database->connect()->prepare('
                    DELETE FROM public.rating WHERE rated_coffee = :id AND rated_by = :userID
                ');

                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

                $stmt->execute();

                return;
            }


            $stmt = $this->database->connect()->prepare('
                UPDATE public.rating SET grade = :rating WHERE rated_coffee = :id AND rated_by = :userID
            ');

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

            $stmt->execute();

            return;
        }

        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.rating (rated_coffee, grade, rated_by)
            VALUES (:id, :rating, :userID)
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function getUserRating(int $id, int $userID): ?int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT grade FROM public.rating WHERE rated_coffee = :id AND rated_by = :userID
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return $result['grade'];
    }

    public function getUserRatingCount(int $userID): ?int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT COUNT(*) FROM public.rating WHERE rated_by = :userID
        ');

        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return $result['count'];
    }
}
