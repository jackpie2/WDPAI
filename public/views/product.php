<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/css/product.css" />
    <link rel="stylesheet" type="text/css" href="public/css/main.css" />
    <title>BrewReview</title>
</head>

<body>
    <div class="main-container">
        <nav>
            <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="34" height="34">
                    <path
                        d="M11.03 2.59a1.501 1.501 0 0 1 1.94 0l7.5 6.363a1.5 1.5 0 0 1 .53 1.144V19.5a1.5 1.5 0 0 1-1.5 1.5h-5.75a.75.75 0 0 1-.75-.75V14h-2v6.25a.75.75 0 0 1-.75.75H4.5A1.5 1.5 0 0 1 3 19.5v-9.403c0-.44.194-.859.53-1.144ZM12 3.734l-7.5 6.363V19.5h5v-6.25a.75.75 0 0 1 .75-.75h3.5a.75.75 0 0 1 .75.75v6.25h5v-9.403Z">
                    </path>
                </svg>
            </a>
            <a href="/saved">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="34" height="34">
                    <path
                        d="M4.801 3.57A1.75 1.75 0 0 1 6.414 2.5h11.174c.702 0 1.337.42 1.611 1.067l3.741 8.828c.04.092.06.192.06.293v7.562A1.75 1.75 0 0 1 21.25 22H2.75A1.75 1.75 0 0 1 1 20.25v-7.5c0-.1.02-.199.059-.291L4.8 3.571ZM6.414 4a.25.25 0 0 0-.23.153L2.88 12H8a.75.75 0 0 1 .648.372L10.18 15h3.638l1.533-2.628a.75.75 0 0 1 .64-.372l5.13-.051-3.304-7.797a.25.25 0 0 0-.23-.152ZM21.5 13.445l-5.067.05-1.535 2.633a.75.75 0 0 1-.648.372h-4.5a.75.75 0 0 1-.648-.372L7.57 13.5H2.5v6.75c0 .138.112.25.25.25h18.5a.25.25 0 0 0 .25-.25Z">
                    </path>
                </svg>
            </a>
            <a href="/profile">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="34" height="34">
                    <path
                        d="M12 2.5a5.5 5.5 0 0 1 3.096 10.047 9.005 9.005 0 0 1 5.9 8.181.75.75 0 1 1-1.499.044 7.5 7.5 0 0 0-14.993 0 .75.75 0 0 1-1.5-.045 9.005 9.005 0 0 1 5.9-8.18A5.5 5.5 0 0 1 12 2.5ZM8 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z">
                    </path>
                </svg>
            </a>
            <a href="/add_product">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="34" height="34">
                    <path
                        d="M11.75 4.5a.75.75 0 0 1 .75.75V11h5.75a.75.75 0 0 1 0 1.5H12.5v5.75a.75.75 0 0 1-1.5 0V12.5H5.25a.75.75 0 0 1 0-1.5H11V5.25a.75.75 0 0 1 .75-.75Z">
                    </path>
                </svg>
            </a>
        </nav>
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
                $rating = $coffee->getFormattedRating();
                $name = $coffee->getName();
                $description = $coffee->getDescription();
                $brand = $coffee->getBrandName();

                $image_file = $coffee->getimage_file();
                $id = $coffee->getId();

                echo "
                    <div class=\"coffee-header\">
                    <div class=\"coffee-image\">
                        <img src=\"public/uploads/$image_file\" alt=\"coffe image\" />
                    </div>
                    <div class=\"coffee-details\">
                        <div class=\"coffee-title\">$name</div>
                        <div class=\"coffee-brand\">$brand</div>
                        <div class=\"coffee-rating\">
                            $stars <span>$rating</span>
                        </div>
                    </div>
                    <div class=\"actions-menu\">
                        <div class=\"stars\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                <path d=\"M12 .25a.75.75 0 0 1 .673.418l3.058 6.197 6.839.994a.75.75 0 0 1 .415 1.279l-4.948 4.823 1.168 6.811a.751.751 0 0 1-1.088.791L12 18.347l-6.117 3.216a.75.75 0 0 1-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 0 1 .416-1.28l6.838-.993L11.328.668A.75.75 0 0 1 12 .25Zm0 2.445L9.44 7.882a.75.75 0 0 1-.565.41l-5.725.832 4.143 4.038a.748.748 0 0 1 .215.664l-.978 5.702 5.121-2.692a.75.75 0 0 1 .698 0l5.12 2.692-.977-5.702a.748.748 0 0 1 .215-.664l4.143-4.038-5.725-.831a.75.75 0 0 1-.565-.41L12 2.694Z\"></path>
                            </svg>
                            <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                <path d=\"M12 .25a.75.75 0 0 1 .673.418l3.058 6.197 6.839.994a.75.75 0 0 1 .415 1.279l-4.948 4.823 1.168 6.811a.751.751 0 0 1-1.088.791L12 18.347l-6.117 3.216a.75.75 0 0 1-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 0 1 .416-1.28l6.838-.993L11.328.668A.75.75 0 0 1 12 .25Zm0 2.445L9.44 7.882a.75.75 0 0 1-.565.41l-5.725.832 4.143 4.038a.748.748 0 0 1 .215.664l-.978 5.702 5.121-2.692a.75.75 0 0 1 .698 0l5.12 2.692-.977-5.702a.748.748 0 0 1 .215-.664l4.143-4.038-5.725-.831a.75.75 0 0 1-.565-.41L12 2.694Z\"></path>
                            </svg>
                            <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                <path d=\"M12 .25a.75.75 0 0 1 .673.418l3.058 6.197 6.839.994a.75.75 0 0 1 .415 1.279l-4.948 4.823 1.168 6.811a.751.751 0 0 1-1.088.791L12 18.347l-6.117 3.216a.75.75 0 0 1-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 0 1 .416-1.28l6.838-.993L11.328.668A.75.75 0 0 1 12 .25Zm0 2.445L9.44 7.882a.75.75 0 0 1-.565.41l-5.725.832 4.143 4.038a.748.748 0 0 1 .215.664l-.978 5.702 5.121-2.692a.75.75 0 0 1 .698 0l5.12 2.692-.977-5.702a.748.748 0 0 1 .215-.664l4.143-4.038-5.725-.831a.75.75 0 0 1-.565-.41L12 2.694Z\"></path>
                            </svg>
                            <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                <path d=\"M12 .25a.75.75 0 0 1 .673.418l3.058 6.197 6.839.994a.75.75 0 0 1 .415 1.279l-4.948 4.823 1.168 6.811a.751.751 0 0 1-1.088.791L12 18.347l-6.117 3.216a.75.75 0 0 1-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 0 1 .416-1.28l6.838-.993L11.328.668A.75.75 0 0 1 12 .25Zm0 2.445L9.44 7.882a.75.75 0 0 1-.565.41l-5.725.832 4.143 4.038a.748.748 0 0 1 .215.664l-.978 5.702 5.121-2.692a.75.75 0 0 1 .698 0l5.12 2.692-.977-5.702a.748.748 0 0 1 .215-.664l4.143-4.038-5.725-.831a.75.75 0 0 1-.565-.41L12 2.694Z\"></path>
                            </svg>
                            <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                <path d=\"M12 .25a.75.75 0 0 1 .673.418l3.058 6.197 6.839.994a.75.75 0 0 1 .415 1.279l-4.948 4.823 1.168 6.811a.751.751 0 0 1-1.088.791L12 18.347l-6.117 3.216a.75.75 0 0 1-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 0 1 .416-1.28l6.838-.993L11.328.668A.75.75 0 0 1 12 .25Zm0 2.445L9.44 7.882a.75.75 0 0 1-.565.41l-5.725.832 4.143 4.038a.748.748 0 0 1 .215.664l-.978 5.702 5.121-2.692a.75.75 0 0 1 .698 0l5.12 2.692-.977-5.702a.748.748 0 0 1 .215-.664l4.143-4.038-5.725-.831a.75.75 0 0 1-.565-.41L12 2.694Z\"></path>
                            </svg>
                        </div>
                        <div class=\"bookmark\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                <path d=\"M5 3.75C5 2.784 5.784 2 6.75 2h10.5c.966 0 1.75.784 1.75 1.75v17.5a.75.75 0 0 1-1.218.586L12 17.21l-5.781 4.625A.75.75 0 0 1 5 21.25Zm1.75-.25a.25.25 0 0 0-.25.25v15.94l5.031-4.026a.749.749 0 0 1 .938 0L17.5 19.69V3.75a.25.25 0 0 0-.25-.25Z\"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"box product-box actions-mobile-box\">
                <div class=\"stars\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                        <path d=\"M12 .25a.75.75 0 0 1 .673.418l3.058 6.197 6.839.994a.75.75 0 0 1 .415 1.279l-4.948 4.823 1.168 6.811a.751.751 0 0 1-1.088.791L12 18.347l-6.117 3.216a.75.75 0 0 1-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 0 1 .416-1.28l6.838-.993L11.328.668A.75.75 0 0 1 12 .25Zm0 2.445L9.44 7.882a.75.75 0 0 1-.565.41l-5.725.832 4.143 4.038a.748.748 0 0 1 .215.664l-.978 5.702 5.121-2.692a.75.75 0 0 1 .698 0l5.12 2.692-.977-5.702a.748.748 0 0 1 .215-.664l4.143-4.038-5.725-.831a.75.75 0 0 1-.565-.41L12 2.694Z\"></path>
                    </svg>
                    <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                        <path d=\"M12 .25a.75.75 0 0 1 .673.418l3.058 6.197 6.839.994a.75.75 0 0 1 .415 1.279l-4.948 4.823 1.168 6.811a.751.751 0 0 1-1.088.791L12 18.347l-6.117 3.216a.75.75 0 0 1-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 0 1 .416-1.28l6.838-.993L11.328.668A.75.75 0 0 1 12 .25Zm0 2.445L9.44 7.882a.75.75 0 0 1-.565.41l-5.725.832 4.143 4.038a.748.748 0 0 1 .215.664l-.978 5.702 5.121-2.692a.75.75 0 0 1 .698 0l5.12 2.692-.977-5.702a.748.748 0 0 1 .215-.664l4.143-4.038-5.725-.831a.75.75 0 0 1-.565-.41L12 2.694Z\"></path>
                    </svg>
                    <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                        <path d=\"M12 .25a.75.75 0 0 1 .673.418l3.058 6.197 6.839.994a.75.75 0 0 1 .415 1.279l-4.948 4.823 1.168 6.811a.751.751 0 0 1-1.088.791L12 18.347l-6.117 3.216a.75.75 0 0 1-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 0 1 .416-1.28l6.838-.993L11.328.668A.75.75 0 0 1 12 .25Zm0 2.445L9.44 7.882a.75.75 0 0 1-.565.41l-5.725.832 4.143 4.038a.748.748 0 0 1 .215.664l-.978 5.702 5.121-2.692a.75.75 0 0 1 .698 0l5.12 2.692-.977-5.702a.748.748 0 0 1 .215-.664l4.143-4.038-5.725-.831a.75.75 0 0 1-.565-.41L12 2.694Z\"></path>
                    </svg>
                    <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                        <path d=\"M12 .25a.75.75 0 0 1 .673.418l3.058 6.197 6.839.994a.75.75 0 0 1 .415 1.279l-4.948 4.823 1.168 6.811a.751.751 0 0 1-1.088.791L12 18.347l-6.117 3.216a.75.75 0 0 1-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 0 1 .416-1.28l6.838-.993L11.328.668A.75.75 0 0 1 12 .25Zm0 2.445L9.44 7.882a.75.75 0 0 1-.565.41l-5.725.832 4.143 4.038a.748.748 0 0 1 .215.664l-.978 5.702 5.121-2.692a.75.75 0 0 1 .698 0l5.12 2.692-.977-5.702a.748.748 0 0 1 .215-.664l4.143-4.038-5.725-.831a.75.75 0 0 1-.565-.41L12 2.694Z\"></path>
                    </svg>
                    <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                        <path d=\"M12 .25a.75.75 0 0 1 .673.418l3.058 6.197 6.839.994a.75.75 0 0 1 .415 1.279l-4.948 4.823 1.168 6.811a.751.751 0 0 1-1.088.791L12 18.347l-6.117 3.216a.75.75 0 0 1-1.088-.79l1.168-6.812-4.948-4.823a.75.75 0 0 1 .416-1.28l6.838-.993L11.328.668A.75.75 0 0 1 12 .25Zm0 2.445L9.44 7.882a.75.75 0 0 1-.565.41l-5.725.832 4.143 4.038a.748.748 0 0 1 .215.664l-.978 5.702 5.121-2.692a.75.75 0 0 1 .698 0l5.12 2.692-.977-5.702a.748.748 0 0 1 .215-.664l4.143-4.038-5.725-.831a.75.75 0 0 1-.565-.41L12 2.694Z\"></path>
                    </svg>
                </div>
                <div class=\"bookmark\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                        <path d=\"M5 3.75C5 2.784 5.784 2 6.75 2h10.5c.966 0 1.75.784 1.75 1.75v17.5a.75.75 0 0 1-1.218.586L12 17.21l-5.781 4.625A.75.75 0 0 1 5 21.25Zm1.75-.25a.25.25 0 0 0-.25.25v15.94l5.031-4.026a.749.749 0 0 1 .938 0L17.5 19.69V3.75a.25.25 0 0 0-.25-.25Z\"></path>
                    </svg>
                </div>
            </div>
            <div class=\"box product-box\">$description</div>
            <div class=\"box product-box\">
                <div class=\"tags\">
                    <div class=\"tag\">tag</div>
                    <div class=\"tag\">tag</div>
                    <div class=\"tag\">tag</div>
                </div>
            </div>
                ";

                ?>

            </div>
        </div>
</body>