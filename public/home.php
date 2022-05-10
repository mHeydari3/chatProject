<?php
session_start();
include "../helper/functions.php";
if (isset($_SESSION['username'])){
    
    



    if (isset($_GET['logout']) && $_GET['logout'] == "true"){
        logout();
    }

}else{
    header('Location: ../view/login.php');
}