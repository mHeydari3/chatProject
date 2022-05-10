<?php
require_once "db.php";
require_once "dbFunctions.php";
require_once "jsonFunctions.php";
if(!defined("config")){
    define( "config" , require __DIR__ . '/../config.php');
}
function logout(){
    session_unset();
    header('Location: login.php');
    
}

function isUserUnique($username){
    
    $DB = new DB();
    $sql = "SELECT * FROM users WHERE username='$username' ";
    $result = $DB->selectQuery($sql);


    foreach($result as $item){
        if( $username == $item['username'] ){

            return false; // username is already picked by someone else and is not unique
        }
    }
    return true; // only will done whenever username is unique
}

function isEmailUnique($email){
    
    $DB = new DB();
    $sql = "SELECT * FROM users WHERE email='$email' ";
    $result = $DB->selectQuery($sql);


    foreach($result as $item){
        if( $email == $item['email'] ){

            return false; // email is already used by someone else and is not unique
        }
    }
    return true; // only will done whenever email is unique
}

function isUsernameValid($username){
    if (strlen($username) > 3 && strlen($username) < 32  && isUserUnique($username)  && preg_match ('/[a-zA-Z0-9_]/', $username) ){
        return true;
    }
    return false;
}

function isEmail($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL) && isEmailUnique($email)) 
        return true;
    return false;
    
}

function isName($name){
    if (strlen($name) > 3 && strlen($name) < 32 && preg_match ('/[a-z ]/', $name))
        return true;
    return false;
}

function isPass($pass){
    if (strlen($pass) > 4 && strlen($pass) < 32 )
        return true;
    return false;
}

function returnJsonContentMessages(){

    if(config['STORAGE']['PREFERED_OPTION'] == "JSON"){
        $json = returnMessageJSON();
    }else if(config['STORAGE']['PREFERED_OPTION']== "DB"){
        $result = returnMessageTBL();
        $json = json_encode($result , true);
    }

    
    
    
    /* var_dump($json); */
    /* return ""; */
    return $json;
    
}

function regroupArray($oldArray){
    $newArray = [];

    foreach($oldArray as $key => $value){
        $newArray[] = $value;
    }
    return $newArray;

}

function InsertNewMessage($data){
    
    require_once "jdf.php";
    

    extract($data);

    if(config['STORAGE']['PREFERED_OPTION']== "JSON"){
        $result = insertNewMessageJSON($username , $text , $data);
    }else if(config['STORAGE']['PREFERED_OPTION']== "DB"){
        $result = InsertNewMessageTBL($username,$text,$data);
    }

    
    return $result;
}

function updateMessage( $username , $text , $message_id  ){
    
    require_once "jdf.php";
    
    
    if(config['STORAGE']['PREFERED_OPTION']== "JSON"){
        $result = updateMessageJSON($message_id ,$text );
    }else if(config['STORAGE']['PREFERED_OPTION']== "DB"){
        $result = updateMessagesTBL($message_id, $text);
    }


    

    echo "<br/>db updated!";
    
    
}

function deleteMessage($message_id){


    if(config['STORAGE']['PREFERED_OPTION']== "JSON"){
        $result = deleteMessageJSON($message_id);
    }else if(config['STORAGE']['PREFERED_OPTION']== "DB"){
        $result = deleteMessageTBL($message_id);
    }

    

    if($result){
        echo "message successfully deleted!";
    }
        
}


function uploadFile($data){

    $username = $_SESSION['username'];

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], "../users/uploads/$username" . '_' . $_FILES['file']['name']);
        
        return "../users/uploads/$username" . '_' . $_FILES['file']['name'];
    }


}

function doLogin($username , $password){
    if(config['STORAGE']['PREFERED_OPTION']== "JSON"){
        $result = checkUserinJSON($username , $password);
    }else if(config['STORAGE']['PREFERED_OPTION']== "DB"){
        $result = checkUserinDB($username, $password);
    }

    return $result;
}

?>