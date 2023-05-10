<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/css/main.css" />
    <title>BrewReview</title>
</head>

<body>
    <div class="main-container">
        <nav>
            <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="34" height="34">
                    <path d="M11.03 2.59a1.501 1.501 0 0 1 1.94 0l7.5 6.363a1.5 1.5 0 0 1 .53 1.144V19.5a1.5 1.5 0 0 1-1.5 1.5h-5.75a.75.75 0 0 1-.75-.75V14h-2v6.25a.75.75 0 0 1-.75.75H4.5A1.5 1.5 0 0 1 3 19.5v-9.403c0-.44.194-.859.53-1.144ZM12 3.734l-7.5 6.363V19.5h5v-6.25a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 .75.75v6.25h5v-9.403Z"></path>
                </svg>
            </a>
            <a href="/saved">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="34" height="34">
                    <path d="M4.801 3.57A1.75 1.75 0 0 1 6.414 2.5h11.174c.702 0 1.337.42 1.611 1.067l3.741 8.828c.04.092.06.192.06.293v7.562A1.75 1.75 0 0 1 21.25 22H2.75A1.75 1.75 0 0 1 1 20.25v-7.5c0-.1.02-.199.059-.291L4.8 3.571ZM6.414 4a.25.25 0 0 0-.23.153L2.88 12H8a.75.75 0 0 1 .648.372L10.18 15h3.638l1.533-2.628a.75.75 0 0 1 .64-.372l5.13-.051-3.304-7.797a.25.25 0 0 0-.23-.152ZM21.5 13.445l-5.067.05-1.535 2.633a.75.75 0 0 1-.648.372h-4.5a.75.75 0 0 1-.648-.372L7.57 13.5H2.5v6.75c0 .138.112.25.25.25h18.5a.25.25 0 0 0 .25-.25Z"></path>
                </svg>
            </a>
            <a href="/profile">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="34" height="34">
                    <path d="M12 2.5a5.5 5.5 0 0 1 3.096 10.047 9.005 9.005 0 0 1 5.9 8.181.75.75 0 1 1-1.499.044 7.5 7.5 0 0 0-14.993 0 .75.75 0 0 1-1.5-.045 9.005 9.005 0 0 1 5.9-8.18A5.5 5.5 0 0 1 12 2.5ZM8 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z"></path>
                </svg>
            </a>
        </nav>
        <div class="content-container">
            <div class="search-bar-container">
                <div class="search-bar">
                    <div class="search-input-container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M10.25 2a8.25 8.25 0 0 1 6.34 13.53l5.69 5.69a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215l-5.69-5.69A8.25 8.25 0 1 1 10.25 2ZM3.5 10.25a6.75 6.75 0 1 0 13.5 0 6.75 6.75 0 0 0-13.5 0Z"></path>
                        </svg>
                        <input type="text" placeholder="Search for a coffee, brand, or type" />
                    </div>
                    <button class="button search-button">Search</button>
                </div>
            </div>
            <div class="coffee-list">
                <?php
                if ($coffee === null) {
                    echo "
                    <div class=\"no-results-box\">
                        No results found.
                    </div>
                    ";

                    return;
                }

                foreach ($coffee as $product) {
                    $name = $product->getName();
                    $description = $product->getDescription();
                    // $image_uuid = $product->getImage_uuid();
                    $rating = $product->getRating();
                    $id = $product->getId();

                    if ($rating == 0) {
                        $rating = "No rating";
                    } else {
                        $rating = $rating . "/5";
                    }

                    $stars = $product->getRatingStars();

                    $brand = $product->getBrand();

                    if ($brand == null) {
                        $brand = "Unknown brand";
                    }

                    echo "
                    <a class=\"product-link\" href=\"/product?id=$id\">
                        <div class=\"coffee-list-entry\">
                            <div class=\"coffee-image\">
                                <img src=\"public/img/coffee.jpg\" alt=\"coffee image\" /> 
                            </div>
                            <div class=\"coffee-content\">
                                <div class=\"coffee-title\">$name</div>
                                <div class=\"coffee-brand\">$brand</div>
                                <div class=\"coffee-rating\">$stars <span>$rating</span></div>
                                <div class=\"coffee-description\">$description</div>

                            </div>
                        </div>
                    </a>
                    ";
                }
                ?>
            </div>
            <div class="nagivation-bar-container">
                <div class="navigation-bar">
                    <button class="navigation-button">
                        < </button>
                            <div class="navigation-pages">
                                <span><?php echo $page ?></span>
                                <span>/</span>
                                <span><?php echo $totalPages ?></span>
                            </div>
                            <button class="navigation-button">></button>
                </div>
            </div>
        </div>
    </div>
</body>