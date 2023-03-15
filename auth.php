<?php

session_start();
include_once 'pdo.php';
//var_dump($_POST);
//echo '$_POST<br>';
//die();

auth();

function auth()
{
    global $db;
    $sql = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $db->prepare($sql);
    //var_dump($stmt);
    //echo '$stmt<br>';
    //die();

    $stmt->execute(['email' => $_POST['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //var_dump($user);
    //echo '$user<br>';
    //die();

    $password_verify = password_verify($_POST['password'], $user['password']);
    //var_dump($password_verify);
    //echo 'a4password_verify<br>';
    //die();
   
    if ($user) {
        if (password_verify($_POST['password'], $user['password'])){
            setLoginStatus($user);
            
            header('Location: dashboard.php');
        } else {
            echo "Wrong password";
        }    
    }
}


function setLoginStatus(array $data)
{
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $data['username'];

    $token = $data['token'];
    $_SESSION['token'] = $token;
    setUserCookie();
    //var_dump($data);
    //echo '$data<br>';
    //die();    
}

function setUserCookie()
{
    if(isset($_POST["remember"])){
        setcookie(
            'login',
            $_SESSION['token'],
            [
                'expires' => time() + 60 * 60 * 24 * 30,
            ]
        );
     }
}