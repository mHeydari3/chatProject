<?php
require_once "functions.php";
function validation($username, $email, $name , $password){
    if (!isUsernameValid($username)) {
        return "نام کاربری معتبر نیست";

    }
    if (!isEmail($email)){
        return "ادرس ایمیل معتبر نیست";
    }
    if(!isName($name)){
        return "نام وارد شده معتبر نیست";
    }
    if (!isPass($password)){
        return "رمز عبور وارد شده معتبر نیست";
    }
    return true;


}