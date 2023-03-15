<?php

// print_r(PDO::getAvailableDrivers());
// phpinfo();

$db_name = "db.sqlite";
 $database = new SQLite3($db_name);


$db = new PDO("sqlite:db.sqlite"); //PHP Data Objects


$table = 'users';
try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Error

    $sql = "CREATE TABLE IF NOT EXISTS $table(
    id INTEGER PRIMERY KEY AUTO_INCREMENT,
    username VARCHAR( 50 ) NOT NULL,
    email VARCHAR( 250 ) NOT NULL,
    password VARCHAR( 150 ) NOT NULL,
    token VARCHAR( 150 ) NOT NULL,
    created VARCHAR( 150 ) NOT NULL);";

    $db->exec($sql) ? print("Created $table Table.\n") : false;
} catch(PDOException $e) {
    echo $e->getMessage(); //Remove or change message in production code 
}



$sql = "SELECT * FROM users";
$result = $db->query($sql);

foreach ($result as $row) {
//print_r($row);
}


function checkCookie()
{
    global $db;
    $cookie = $_COOKIE['login'];

    $sql = "SELECT * FROM `users` WHERE `token` = :token";

    $stmt = $db->prepare($sql);

    $stmt->execute(['token' => $cookie]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        header('location: /dashboard.php');
    }
}