<?php
session_start();
include "../messages.php";

$json_url = "../users/users.json";
$json = file_get_contents($json_url);
$jsonArray = json_decode($json,true);

$loginIncorrect = 0;

if(isset($_POST)){
    if (isset($_POST['username']) && isset($_POST['password'])){
        extract($_POST);

        $isLogined = 0;

        foreach($jsonArray as $item){
            if(
               $username == $item['username'] && 
               $password == $item['password']
              ){
                $isLogined = 1;
                $_SESSION['username'] = $username;
                if (isset($item['permission'])){
                    if ($item['permission'] == "admin"){
                        $_SESSION['permission'] = "admin";
                    }
                }
                break;
            }else{
                $loginIncorrect = 1;
            }
        }

        

    }
}else if(isset($_SESSION['username'] )){
    $isLogined = 1;
}


?>