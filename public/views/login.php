<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/css/login.css" />
    <title>Login</title>
</head>

<body>
    <div class="login-screen-container">
        <div class="login-box box">
            <form class="login-form" action="user_login" method="post">
                <div class="login">
                    <div class="messages">
                        <?php
                        if (isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <span>Email</span>
                    <input name="email" type="text" placeholder="email@email.com" />
                </div>
                <div class="login">
                    <span>Password</span>
                    <input name="password" type="password" placeholder="password" />
                </div>
                <button class="login-button" type="submit">Login</button>
            </form>
        </div>
        <div class="logo">
            <img src="public/img/logo.png" class="logo-large" alt="logo" />
        </div>
    </div>
</body>