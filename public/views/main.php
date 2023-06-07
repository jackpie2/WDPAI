<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/main.css"/>
    <script src="public/js/pagination.js" defer></script>
    <script src="public/js/search.js" defer></script>
    <script src="https://kit.fontawesome.com/f0785dd1e7.js" crossorigin="anonymous"></script>

    <title>BrewReview</title>
</head>

<body class="overflow-y">
<div class="main-container">

    <?php require_once __DIR__ . '/../templates/navbar.php'; ?>

    <div class="content-container">
        <div class="search-bar-container">
            <div class="search-bar">
                <div class="search-input-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path
                                d="M10.25 2a8.25 8.25 0 0 1 6.34 13.53l5.69 5.69a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215l-5.69-5.69A8.25 8.25 0 1 1 10.25 2ZM3.5 10.25a6.75 6.75 0 1 0 13.5 0 6.75 6.75 0 0 0-13.5 0Z">
                        </path>
                    </svg>
                    <input type="text" id="search-input" placeholder="Search for a coffee or brand"
                           onkeydown="if (event.keyCode === 13) {search();}"/>
                </div>
                <button class="button search-button" onclick="search();">Search</button>
            </div>
        </div>
        <div id="loading">
            <i class="loading fas fa-spinner fa-pulse"></i>
        </div>
        <div class="coffee-list">
        </div>
        <div class="nagivation-bar-container">
            <div class="navigation-bar">
                <button class="navigation-button" id="previous" onclick="previous();">
                    <svg class="navigation-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                         height="24">
                        <path
                                d="M15.28 5.22a.75.75 0 0 1 0 1.06L9.56 12l5.72 5.72a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215l-6.25-6.25a.75.75 0 0 1 0-1.06l6.25-6.25a.75.75 0 0 1 1.06 0Z">
                        </path>
                    </svg>
                </button>
                <div class="navigation-pages">
                        <span id="current-page">
                            0
                        </span>
                    <span>/</span>
                    <span id="total-pages">
                            0
                        </span>
                </div>
                <button class="navigation-button" id="next" onclick="next();">
                    <svg class="navigation-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                         height="24">
                        <path
                                d="M8.72 18.78a.75.75 0 0 1 0-1.06L14.44 12 8.72 6.28a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018l6.25 6.25a.75.75 0 0 1 0 1.06l-6.25 6.25a.75.75 0 0 1-1.06 0Z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
</body>

<template id="coffee-template">
    <a class="product-link" href="product?id=$id">
        <div class="coffee-list-entry">
            <div class="coffee-image">
                <img src="" alt="coffee image"/>
            </div>
            <div class="coffee-content">
                <div class="coffee-title">Untitled</div>
                <div class="coffee-brand">Unknown brand</div>
                <div class="coffee-rating"></div>
                <div class="coffee-description"></div>
            </div>
        </div>
    </a>
</template>