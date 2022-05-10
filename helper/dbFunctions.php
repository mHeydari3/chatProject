<?php

require_once "db.php";
if(!defined("config")){
    define( "config" , require __DIR__ . '/../config.php');
}
function deleteMessageTBL($message_id){
    $DB = new DB();
    $sql = "DELETE FROM messages WHERE id=$message_id";
    $result = $DB->executeQuery($sql);
    return $result;
}

function returnMessageTBL(){
    $DB = new DB();
    $sql = "SELECT * FROM messages ";
    $result = $DB->selectQuery($sql);
    
    foreach( $result as $key=>&$value){
        if(array_key_exists("image_src" , $value)){
            if($value["image_src"] == ""){
                unset($value["image_src"]);
            }
            
        }    
    }
    /* var_dump($result); */
    return $result;
}

function InsertNewMessageTBL($username,$text , $data){
    $currentDateTime =  jdate('Y/n/j') . " " . jdate('H:i:s');

    $inputdata = "";
    $DB = new DB();
    $sql = "INSERT INTO `messages` (`id`, `name` , `sender`, `text_message`, `date`,`image_src`) 
            VALUES 
            ";
    $image_src = "";

    

    if (isset($data['image_src']) ) {
        $image_src = $data['image_src'];
        $inputdata = "(NULL,'$username',  '$username', '$text', '$currentDateTime','$image_src');";
        $sql .= $inputdata;
        
    }else{
        $inputdata = "(NULL,'$username',  '$username', '$text', '$currentDateTime','$image_src');";
        $sql .= $inputdata;
    }

    $result = $DB->insertInto($sql);
    return $result;
}

function updateMessagesTBL($message_id, $text){
    $DB = new DB();
    $sql = "SELECT * FROM messages WHERE id='$message_id' ";
    $result = $DB->selectQuery($sql);
    

    if ($result){
            echo "id foundout";
            $currentDate = jdate('Y/n/j') . " " . jdate('H:i:s');
            $sql = "UPDATE messages SET text_message='$text' , date = '$currentDate' WHERE id='$message_id' ";
            $resultUpdate = $DB->executeQuery($sql);


            print_r($resultUpdate);
            return $resultUpdate;
    }
}

function checkUserinDB($username, $password){
    $DB = new DB();
    $sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
    $result = $DB->selectQuery($sql);
    return $result;
}