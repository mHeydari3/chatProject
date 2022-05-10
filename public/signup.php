<?php
session_start();
include "../helper/functions.php";
include "../helper/validation.php";


if (isset($_SESSION['username'])){
    header('Location: ../view/home.php');
}

$json_url = "../users/users.json";
$json = file_get_contents($json_url);
$jsonArray = json_decode($json,true);
$error =  "";
if(isset($_POST) && !isset($_SESSION['username'])){
    if (isset($_POST['username']) && isset($_POST['password'])){
        
        extract($_POST);

        
        if (validation($username, $email, $name , $password) === true) {

            $jsonArray[] = [
                'id'=>count($jsonArray)+1 ,
                'name'    => $name    ,
                'username'=> $username,
                'password'=> $password,
                'email'   => $email
                ];

            file_put_contents($json_url,json_encode($jsonArray,JSON_PRETTY_PRINT));
            echo "success signup";
            $_SESSION['username'] = $username;
            header("Location: ../view/home.php");
        }else{
            $error =  validation($username, $email, $name , $password);
            $_SESSION['errors'] = $error;
            header('Location: ../view/signup.php');
        }


        
    }
}






?>