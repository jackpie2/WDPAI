<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/profile.css"/>
    <script src="https://kit.fontawesome.com/f0785dd1e7.js" crossorigin="anonymous"></script>

    <title>BrewReview</title>
</head>

<body>
<div class="main-container">
    <?php require_once __DIR__ . '/../templates/navbar.php'; ?>
    <div class="content-container">
        <div class="profile-box box">
            <div class="profile-info">
                <div class="profile-info-element">
                    <span class="header">Username</span>
                    <span class="username">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo $_SESSION['user'];
                        }
                        ?>
                    </span>
                </div>
                <div class="profile-info-element">
                    <span class="header">Email</span>
                    <span class="email">
                        <?php
                        if (isset($_SESSION['email'])) {
                            echo $_SESSION['email'];
                        }
                        ?>
                    </span>
                </div>
                <div class="profile-info-element">
                    <span class="header">Rated Products</span>
                    <span class="rated-products">
                        <?php
                        echo $ratedProducts;
                        ?>
                    </span>
                </div>
            </div>
            <form class="logout-form" action="user_logout" method="post">
                <button class="logout-button" type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>
</body>