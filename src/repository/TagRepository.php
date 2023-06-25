<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Tag.php';

class TagRepository extends Repository
{
    public function tagCoffee(array $tags, int $coffeeID): void
    {
        foreach ($tags as $tag) {
            if ($tag == '') {
                continue;
            }

            $tagID = $this->database->connect()->prepare('
                SELECT id FROM public.tag WHERE name = :name
            ');

            $tagID->bindParam(':name', $tag, PDO::PARAM_STR);

            $tagID->execute();

            $tagID = $tagID->fetch(PDO::FETCH_ASSOC);

            if ($tagID == false) {
                $tagID = $this->addTag(new Tag($tag));
            } else {
                $tagID = $tagID['id'];
            }

            $stmt = $this->database->connect()->prepare('
                SELECT id FROM public.coffee_tag WHERE coffee_id = :coffee_id AND tag_id = :tag_id
            ');

            $stmt->bindParam(':coffee_id', $coffeeID, PDO::PARAM_INT);
            $stmt->bindParam(':tag_id', $tagID, PDO::PARAM_INT);

            $stmt->execute();

            $foundTagID = $stmt->fetch(PDO::FETCH_ASSOC);
            $foundTagID = $foundTagID['id'];

            if ($foundTagID === NULL) {
                $stmt = $this->database->connect()->prepare('
                    INSERT INTO public.coffee_tag (coffee_id, tag_id)
                    VALUES (:coffee_id, :tag_id)
                ');

                $stmt->bindParam(':coffee_id', $coffeeID, PDO::PARAM_INT);
                $stmt->bindParam(':tag_id', $tagID, PDO::PARAM_INT);

                $stmt->execute();
            }
        }
    }

    public function addTag(Tag $tag): int
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.tag (name)
            VALUES (:name)
            returning id
        ');

        $stmt->bindParam(':name', $tag->getName(), PDO::PARAM_STR);

        $stmt->execute();

        $tagID = $stmt->fetch(PDO::FETCH_ASSOC);

        return $tagID['id'];
    }

    public function getTags(int $coffeeID): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT tag.name FROM public.tag tag
            JOIN public.coffee_tag coffee_tag ON tag.id = coffee_tag.tag_id
            WHERE coffee_tag.coffee_id = :coffee_id
        ');

        $stmt->bindParam(':coffee_id', $coffeeID, PDO::PARAM_INT);

        $stmt->execute();

        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tags;
    }
}
