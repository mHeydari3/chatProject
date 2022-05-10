<?php
session_start();
include "../messages.php";
include_once  "../helper/db.php";
require_once "../helper/functions.php";

if(!defined("config")){
    define( "config" , require __DIR__ . '/../config.php');
}


$json_url = "../users/users.json";
$json = file_get_contents($json_url);
$jsonArray = json_decode($json,true);

$loginIncorrect = 0;

if(isset($_POST)){
    if (isset($_POST['username']) && isset($_POST['password'])){
        extract($_POST);

        $isLogined = 0;

        
        $result = doLogin($username, $password);

        
            if($result){
                $isLogined = 1;
                $_SESSION['username'] = $username;
                if (isset($result['permission'])){
                    if ($result['permission'] == "admin"){
                        $_SESSION['permission'] = "admin";
                    }
                }
                
            }else{
                $loginIncorrect = 1;
            }
        

        

    }
}else if(isset($_SESSION['username'] )){
    $isLogined = 1;
}


?>