<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/css/product.css" />
    <link rel="stylesheet" type="text/css" href="public/css/main.css" />
    <title>BrewReview</title>
    <script src="public/js/rate.js"></script>
    <script src="public/js/bookmark.js"></script>
</head>

<body>
    <div class="main-container">
        <?php require_once __DIR__ . '/../templates/navbar.php'; ?>
        <div class="content-container">
            <div class="box product-box">
                <?php
                if ($coffee === null) {
                    echo "
                        <div class=\"no-results-box\">
                            No results found.
                        </div>
                        ";

                    return;
                }

                $stars = $coffee->getRatingStars();
                $name = $coffee->getName();
                $description = $coffee->getDescription();
                $brand = $coffee->getBrandName();
                $review_count = $coffee->getReviewCount();
                $image_file = $coffee->getimage_file();
                $id = $coffee->getId();
                $bookmarkedClass = $isBookmarked ? 'bookmarked' : '';

                echo "
                        <div class='coffee-header'>
                        <div class='coffee-image'>
                            <img src='public/uploads/$image_file' alt='coffe image' />
                        </div>
                        <div class='coffee-details'>
                            <div class='coffee-title'>$name</div>
                            <div class='coffee-brand'>$brand</div>
                            <div class='coffee-rating'>
                                $stars <span class='review-count'>$review_count <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' width='16' height='16'><path d='M2 5.5a3.5 3.5 0 1 1 5.898 2.549 5.508 5.508 0 0 1 3.034 4.084.75.75 0 1 1-1.482.235 4 4 0 0 0-7.9 0 .75.75 0 0 1-1.482-.236A5.507 5.507 0 0 1 3.102 8.05 3.493 3.493 0 0 1 2 5.5ZM11 4a3.001 3.001 0 0 1 2.22 5.018 5.01 5.01 0 0 1 2.56 3.012.749.749 0 0 1-.885.954.752.752 0 0 1-.549-.514 3.507 3.507 0 0 0-2.522-2.372.75.75 0 0 1-.574-.73v-.352a.75.75 0 0 1 .416-.672A1.5 1.5 0 0 0 11 5.5.75.75 0 0 1 11 4Zm-5.5-.5a2 2 0 1 0-.001 3.999A2 2 0 0 0 5.5 3.5Z'></path></svg></span>
                            </div>
                        </div>
                    ";

                if (isset($_SESSION['id'])) {
                    echo "
                        <div id='actions-menu'>
                            <div class='stars'>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' onclick='rate(1);' class='filled'>
                                    <path d='m12.672.668 3.059 6.197 6.838.993a.75.75 0 0 1 .416 1.28l-4.948 4.823 1.168 6.812a.75.75 0 0 1-1.088.79L12 18.347l-6.116 3.216a.75.75 0 0 1-1.088-.791l1.168-6.811-4.948-4.823a.749.749 0 0 1 .416-1.279l6.838-.994L11.327.668a.75.75 0 0 1 1.345 0Z'>
                                </svg>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' onclick='rate(2);'>
                                    <path d='m12.672.668 3.059 6.197 6.838.993a.75.75 0 0 1 .416 1.28l-4.948 4.823 1.168 6.812a.75.75 0 0 1-1.088.79L12 18.347l-6.116 3.216a.75.75 0 0 1-1.088-.791l1.168-6.811-4.948-4.823a.749.749 0 0 1 .416-1.279l6.838-.994L11.327.668a.75.75 0 0 1 1.345 0Z'>
                                </svg>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' onclick='rate(3);'>
                                    <path d='m12.672.668 3.059 6.197 6.838.993a.75.75 0 0 1 .416 1.28l-4.948 4.823 1.168 6.812a.75.75 0 0 1-1.088.79L12 18.347l-6.116 3.216a.75.75 0 0 1-1.088-.791l1.168-6.811-4.948-4.823a.749.749 0 0 1 .416-1.279l6.838-.994L11.327.668a.75.75 0 0 1 1.345 0Z'>
                                </svg>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' onclick='rate(4);'>
                                    <path d='m12.672.668 3.059 6.197 6.838.993a.75.75 0 0 1 .416 1.28l-4.948 4.823 1.168 6.812a.75.75 0 0 1-1.088.79L12 18.347l-6.116 3.216a.75.75 0 0 1-1.088-.791l1.168-6.811-4.948-4.823a.749.749 0 0 1 .416-1.279l6.838-.994L11.327.668a.75.75 0 0 1 1.345 0Z'>
                                </svg>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' onclick='rate(5);'>
                                    <path d='m12.672.668 3.059 6.197 6.838.993a.75.75 0 0 1 .416 1.28l-4.948 4.823 1.168 6.812a.75.75 0 0 1-1.088.79L12 18.347l-6.116 3.216a.75.75 0 0 1-1.088-.791l1.168-6.811-4.948-4.823a.749.749 0 0 1 .416-1.279l6.838-.994L11.327.668a.75.75 0 0 1 1.345 0Z'>
                                </svg>
                            </div>
                            <div class='bookmark $bookmarkedClass'>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='34' height='34' onclick='bookmark();'>
                                    <path d='M6.69 2h10.56c.966 0 1.75.784 1.75 1.75v17.5a.75.75 0 0 1-1.218.585L12 17.21l-5.781 4.626A.75.75 0 0 1 5 21.253L4.94 3.756A1.748 1.748 0 0 1 6.69 2Z'>
                                    </path>
                                </svg>
                            </div>
                        </div>";
                }

                echo "  
                    </div>
                </div>";

                if (
                    isset($_SESSION['id'])
                ) {
                    echo "
                <div class='box product-box' id='actions-mobile-box'>
                    <div class='stars stars-mobile'>
                      <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' onclick='rate(1);' class='filled'>
                            <path d='m12.672.668 3.059 6.197 6.838.993a.75.75 0 0 1 .416 1.28l-4.948 4.823 1.168 6.812a.75.75 0 0 1-1.088.79L12 18.347l-6.116 3.216a.75.75 0 0 1-1.088-.791l1.168-6.811-4.948-4.823a.749.749 0 0 1 .416-1.279l6.838-.994L11.327.668a.75.75 0 0 1 1.345 0Z'>
                        </svg>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' onclick='rate(2);'>
                            <path d='m12.672.668 3.059 6.197 6.838.993a.75.75 0 0 1 .416 1.28l-4.948 4.823 1.168 6.812a.75.75 0 0 1-1.088.79L12 18.347l-6.116 3.216a.75.75 0 0 1-1.088-.791l1.168-6.811-4.948-4.823a.749.749 0 0 1 .416-1.279l6.838-.994L11.327.668a.75.75 0 0 1 1.345 0Z'>
                        </svg>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' onclick='rate(3);'>
                            <path d='m12.672.668 3.059 6.197 6.838.993a.75.75 0 0 1 .416 1.28l-4.948 4.823 1.168 6.812a.75.75 0 0 1-1.088.79L12 18.347l-6.116 3.216a.75.75 0 0 1-1.088-.791l1.168-6.811-4.948-4.823a.749.749 0 0 1 .416-1.279l6.838-.994L11.327.668a.75.75 0 0 1 1.345 0Z'>
                        </svg>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' onclick='rate(4);'>
                            <path d='m12.672.668 3.059 6.197 6.838.993a.75.75 0 0 1 .416 1.28l-4.948 4.823 1.168 6.812a.75.75 0 0 1-1.088.79L12 18.347l-6.116 3.216a.75.75 0 0 1-1.088-.791l1.168-6.811-4.948-4.823a.749.749 0 0 1 .416-1.279l6.838-.994L11.327.668a.75.75 0 0 1 1.345 0Z'>
                        </svg>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24' onclick='rate(5);'>
                            <path d='m12.672.668 3.059 6.197 6.838.993a.75.75 0 0 1 .416 1.28l-4.948 4.823 1.168 6.812a.75.75 0 0 1-1.088.79L12 18.347l-6.116 3.216a.75.75 0 0 1-1.088-.791l1.168-6.811-4.948-4.823a.749.749 0 0 1 .416-1.279l6.838-.994L11.327.668a.75.75 0 0 1 1.345 0Z'>
                        </svg>
                    </div>
                    <div class='bookmark $bookmarkedClass'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='34' height='34' onclick='bookmark();'>
                        <path d='M6.69 2h10.56c.966 0 1.75.784 1.75 1.75v17.5a.75.75 0 0 1-1.218.585L12 17.21l-5.781 4.626A.75.75 0 0 1 5 21.253L4.94 3.756A1.748 1.748 0 0 1 6.69 2Z'>
                        </path>
                    </svg>
                    </div>
                </div>";
                }

                echo "
                
                <div class='box product-box'>
                    <h3>Description</h3>
                    <p>
                        $description
                    </p>
                </div>";

                echo "
                <div class='box product-box'>
                    <h3>Tags</h3>";
                if ($tags != NULL) {
                    echo "
                    <div class='tags'>
                        ";
                    for ($i = 0; $i < count($tags); $i++) {
                        $tagName = $tags[$i]['name'];
                        echo "<div class='tag'>$tagName</div>";
                    }
                    echo "
                    </div>
                ";
                } else {
                    echo "
                    <p>
                        No tags
                    </p>";
                };

                echo "
                </div>
                <script>
                    updateStars($userRating)
                </script>
                ";
                ?>

            </div>
        </div>
        <?php require_once __DIR__ . '/../templates/footer.php'; ?>
</body>