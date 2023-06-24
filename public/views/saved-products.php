<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/css/main.css" />
    <link rel="stylesheet" type="text/css" href="public/css/saved-products.css" />
    <title>BrewReview</title>
</head>

<body>
    <div class="main-container">
        <?php require_once __DIR__ . '/../templates/navbar.php'; ?>
        <div class="content-container">
            <div class="coffee-list">
                <?php
                // $stars = $coffee->getRatingStars();
                // $rating = $coffee->getFormattedRating();
                // $name = $coffee->getName();
                // $description = $coffee->getDescription();
                // $brand = $coffee->getBrandName();
                // $review_count = $coffee->getReviewCount();

                // $image_file = $coffee->getimage_file();
                // $id = $coffee->getId();

                if ($savedProducts == null) {
                    echo "<div class='no-saved-products'>You have no saved products</div>";
                } else {
                    for ($i = 0; $i < count($savedProducts); $i++) {
                        $coffee = $savedProducts[$i];
                        $image = $coffee->getimage_file();
                        $name = $coffee->getName();
                        $description = $coffee->getDescription();
                        $brand = $coffee->getBrandName();
                        $review_count = $coffee->getReviewCount();
                        $stars = $coffee->getRatingStars();
                        $id = $coffee->getId();

                        echo "
                        <a class='product-link' href='product?id=$id'>
                        <div class='coffee-list-entry'>
                                <div class='coffee-image'>
                                    <img src='public/uploads/$image' alt='coffee image' />
                                </div>
                                <div class='coffee-content'>
                                    <div class='coffee-title'>$name</div>
                                    <div class='coffee-brand'>$brand</div>
                                    <div class='coffee-rating'>$stars <span class='review-count'>$review_count  <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' width='16' height='16'><path d='M2 5.5a3.5 3.5 0 1 1 5.898 2.549 5.508 5.508 0 0 1 3.034 4.084.75.75 0 1 1-1.482.235 4 4 0 0 0-7.9 0 .75.75 0 0 1-1.482-.236A5.507 5.507 0 0 1 3.102 8.05 3.493 3.493 0 0 1 2 5.5ZM11 4a3.001 3.001 0 0 1 2.22 5.018 5.01 5.01 0 0 1 2.56 3.012.749.749 0 0 1-.885.954.752.752 0 0 1-.549-.514 3.507 3.507 0 0 0-2.522-2.372.75.75 0 0 1-.574-.73v-.352a.75.75 0 0 1 .416-.672A1.5 1.5 0 0 0 11 5.5.75.75 0 0 1 11 4Zm-5.5-.5a2 2 0 1 0-.001 3.999A2 2 0 0 0 5.5 3.5Z'></path></svg></span></div>
                                    <div class='coffee-description'>$description</div>
                                </div>
                            </div>
                        </a>";
                    };
                }

                ?>
            </div>
        </div>
    </div>
    <?php require_once __DIR__ . '/../templates/footer.php'; ?>
</body>