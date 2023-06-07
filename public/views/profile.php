<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/css/profile.css" />
    <title>BrewReview</title>
</head>

<body>
    <div class="main-container">
        <?php require_once __DIR__ . '/../templates/navbar.php'; ?>
        <div class="content-container">
            <div class="profile-box box">
                <div class="profile-info">
                    <div class="profile-info-element">
                        <h2>Username</h2>
                        <span class="username">
                            <?php
                            if (isset($_SESSION['user'])) {
                                echo $_SESSION['user'];
                            }
                            ?>
                        </span>
                    </div>
                    <div class="profile-info-element">
                        <h2>Email</h2>
                        <span class="email">
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo $_SESSION['email'];
                            }
                            ?>
                        </span>
                    </div>
                    <div class="profile-info-element">
                        <h2>Rated Products</h2>
                        <span class="rated-products">
                            <?php
                            if (isset($_SESSION['ratedProducts'])) {
                                echo $_SESSION['ratedProducts'];
                            } else {
                                echo 0;
                            }
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