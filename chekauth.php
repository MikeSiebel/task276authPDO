<?php
session_start();
//var_dump($_SESSION['loggedin']);
//die();
if ($_SESSION['loggedin'] == NULL) {
             header('Location: index.php');    
        } else {
            //header('Location: for_authorized_users.php');
            header('Location: for_authorized_users.php');
        }    
  