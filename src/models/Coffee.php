<?

class Coffee
{
    private $id;
    private $name;
    private $description;
    private $image_uuid;
    private $rating;
    private $brand;
    private $review_count;

    public function __construct(int $id, string $name, string $description, ?string $image_uuid, ?float $rating, ?string $brand, int $review_count)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image_uuid = $image_uuid;
        $this->rating = $rating;
        $this->brand = $brand;
        $this->review_count = $review_count;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return  $this->description;
    }

    public function getImage_uuid(): string
    {
        return $this->image_uuid;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function getFormattedRating(): string
    {
        if ($this->rating == 0) {
            $rating = "No rating";
        } else {
            $rating = $this->rating . "/5";
        }

        return $rating;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImage_uuid(string $image_uuid): void
    {
        $this->image_uuid = $image_uuid;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function getRatingStars(): string
    {
        $stars = "";
        for ($i = 0; $i < $this->rating; $i++) {
            $stars .= '
            <div class="star filled">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                    <path d="M8 .25a.75.75 0 0 1 .673.418l1.882 3.815 4.21.612a.75.75 0 0 1 .416 1.279l-3.046 2.97.719 4.192a.751.751 0 0 1-1.088.791L8 12.347l-3.766 1.98a.75.75 0 0 1-1.088-.79l.72-4.194L.818 6.374a.75.75 0 0 1 .416-1.28l4.21-.611L7.327.668A.75.75 0 0 1 8 .25Z"></path>
                </svg>
            </div>
            ';
        }

        if ($i < 5) {
            for ($i; $i < 5; $i++) {
                $stars .= '
                <div class="star">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                        <path d="M8 .25a.75.75 0 0 1 .673.418l1.882 3.815 4.21.612a.75.75 0 0 1 .416 1.279l-3.046 2.97.719 4.192a.751.751 0 0 1-1.088.791L8 12.347l-3.766 1.98a.75.75 0 0 1-1.088-.79l.72-4.194L.818 6.374a.75.75 0 0 1 .416-1.28l4.21-.611L7.327.668A.75.75 0 0 1 8 .25Z"></path>
                    </svg>
                </div>
                ';
            }
        }

        return $stars;
    }

    public function getBrand(): string
    {
        if ($this->brand == null) {
            return "Unknown brand";
        }

        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getReview_count(): int
    {
        return $this->review_count;
    }
}
