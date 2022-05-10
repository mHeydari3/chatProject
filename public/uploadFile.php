<?php
session_start();
require_once "../helper/functions.php";
if(isset($_POST) && isset($_FILES)){
    $file_url = uploadFile($_FILES);
    echo $file_url;
}