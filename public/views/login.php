<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/css/login.css" />
    <title>Login</title>
</head>

<body>
    <div class="messages">
        <?php
        if (isset($messages)) {
            foreach ($messages as $message) {
                echo "
                            <div class=\"message\">
                                <div class=\"message-content\">
                                    <span>$message</span>
                                    <button class=\"message-close-button\" 
                                    onclick=\"this.parentElement.parentElement.style.display='none';\"
                                    >X</button>
                                </div>
                            </div>
                        ";
            }
        }
        ?>
    </div>
    <div class="login-screen-container">
        <div class="login-box box">
            <form class="login-form" action="<?php
                                                if (isset($type) && $type === 'register') {
                                                    echo "userRegister";
                                                } else {
                                                    echo "userLogin";
                                                }
                                                ?>" method="post">
                <?php
                if (isset($type) && $type === 'register') {
                    echo "
                            <div class=\"login\">
                                <span>Nickname</span>
                                <input name=\"nickname\" type=\"text\" placeholder=\"nickname\" />
                            </div>
                        ";
                }
                ?>
                <div class="login">
                    <span>Email</span>
                    <input name="email" type="text" placeholder="email@email.com" />
                </div>
                <div class="login">
                    <span>Password</span>
                    <input name="password" type="password" placeholder="password" />
                </div>
                <?php
                if (isset($type) && $type === 'register') {
                    echo "
                            <div class=\"login\">
                                <span>Confirm Password</span>
                                <input name=\"confirm-password\" type=\"password\" placeholder=\"password\" />
                            </div>
                        ";
                }
                ?>
                <button class="login-button" type="submit">
                    <?php
                    if (isset($type) && $type === 'register') {
                        echo "Register";
                    } else {
                        echo "Login";
                    }
                    ?>
                </button>
                <?php
                if (isset($type) && $type === 'register') {
                    echo "
                            <div class=\"alternative-action\">
                                <span>Already have an account?</span>
                                <a href=\"/login\">Login</a>
                            </div>
                        ";
                } else {
                    echo "
                            <div class=\"alternative-action\">
                                <span>Don't have an account?</span>
                                <a href=\"/register\">Register</a>
                            </div>
                        ";
                }
                ?>
            </form>
        </div>
        <div class="logo">
            <img src="public/img/logo.png" class="logo-large" alt="logo" />
        </div>
    </div>
    <?php require_once __DIR__ . '/../templates/footer.php'; ?>
</body>