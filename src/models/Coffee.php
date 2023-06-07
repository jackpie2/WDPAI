<?

require_once __DIR__ . '/../repository/BrandRepository.php';

class Coffee
{
    private $id;
    private $name;
    private $description;
    private $image_file;
    private $rating;
    private $brand;
    private $review_count;

    public function __construct(
        string  $name,
        string  $description,
        ?string $image_file,
        ?float  $rating,
        ?string $brand,
        int     $review_count,
        ?int    $id = null
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->image_file = $image_file;
        $this->rating = $rating;
        $this->brand = $brand;
        $this->review_count = $review_count;
        $this->id = $id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getimage_file(): ?string
    {
        return $this->image_file;
    }

    public function setimage_file(string $image_file): void
    {
        $this->image_file = $image_file;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
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

    public function getReviewCount(): int
    {
        return $this->review_count;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrandName(): string
    {
        $brandRepository = new BrandRepository();
        $brand = $brandRepository->getBrand($this->brand);

        if ($brand == null) {
            return "Unknown brand";
        }

        return $brand->getName();
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
