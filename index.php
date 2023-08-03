<?php
session_start();
//print_r(PDO::getAvailableDrivers()); //посмотреть доступные драйверы

include_once 'pdo.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php
            echo  require 'header.php';         
        ?>
    </header>
    <div class="container">
        <main>
            <section>
                <form class="form_register" action="reg.php" method="post">
                    <legend>
                        <h3>Регистрация</h3>
                    </legend>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password">
                    <label for="password2">Confirm Password</label>
                    <input type="text" name="password2" id="password2">
                <button type="submit">Send</button> 
                </form>
            </section>
            <section>
                <form class="form_register" action="auth.php" method="post">
                    <legend>
                        <h3>Авторизация</h3>
                    </legend>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password">
                    <button type="submit">Send</button> 
                </form>
            </section>
            <section>
                <!--<a href="vk.php">Авторизоваться через VK</a>-->
                <form class="vk_register" action="vk.php" method="">
                    <legend>
                        <h3>Авторизоваться через VK</h3>
                    </legend>                    
                    <button type="submit">Send VK</button> 
                </form>
            </section>
        </main>
    </div>
</body>
</html>