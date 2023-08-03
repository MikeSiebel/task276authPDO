<?php

session_start();
//var_dump($_POST);
include_once 'pdo.php';

function register(array $data)
{
    $values = [
        //'id'=>unique(),
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => password_hash($data['password'], PASSWORD_DEFAULT) ,
        'token' => password_hash($data['email'], PASSWORD_DEFAULT) ,
        'date' => (new DateTime()) -> format('Y-m-d H:i:s')
    ];
    return $values;
}

$user = register($_POST);

/// PDO version

$sql = "INSERT INTO `users` (`username`, `email`, `password`, `token`, 
`created`) VALUES (:username, :email, :password, :token, :date)";
$stmt = $db->prepare($sql);

$stmt->execute($user);

$stmt->closeCursor();

//$db = null;


//var_dump($user);
setLoginStatus($user);
function setLoginStatus(array $data)
{
    $token = password_hash($data['email'], PASSWORD_DEFAULT);
    $_SESSION['username'] = $data['username'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['date'] = $data['date'];
    $_SESSION['id'] = $data['id'];
    $_SESSION['token'] = $token;
    $_SESSION['loggedin'] = true;
    storeUserToCookies();
}

function storeUserToCookies(){

    //var_dump($_SESSION);
    setcookie(
         'login', 
         $_SESSION['token']
          /*[
              'expires' => time() + 3600
              //'samesite' => 'Lax'
          ]*/
     );
}

$sql = "SELECT * FROM users";
$result = $db->query($sql);

/*foreach ($result as $row) {
    print_r($row);
}*/
header('Location: dashboard.php');


