<?php
function logout(){
    session_unset();
    header('Location: login.php');
    
}

function isUserUnique($username){
    $json_url = "../users/users.json";
    $json = file_get_contents($json_url);
    $jsonArray = json_decode($json,true);
    foreach($jsonArray as $item){
        if( $username == $item['username'] ){

            return false; // username is already picked by someone else and is not unique
        }
    }
    return true; // only will done whenever username is unique
}

function isEmailUnique($email){
    $json_url = "../users/users.json";
    $json = file_get_contents($json_url);
    $jsonArray = json_decode($json,true);
    foreach($jsonArray as $item){
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

function returnJsonContent($url){
    $json_url = $url;
    $json = file_get_contents($json_url);
    return $json;
}

function regroupArray($oldArray){
    $newArray = [];

    foreach($oldArray as $key => $value){
        $newArray[] = $value;
    }
    return $newArray;

}

function insertDataToJson($data, $url){
    
    require_once "jdf.php";
    

    extract($data);
    
    $json_url = $url;
    $json = file_get_contents($json_url);
    $jsonArray = json_decode($json,true);
    $jsonArray[] = [
        'id'          => count($jsonArray)+1 ,
        'sender'      => $username,
        'text_message'=> $text,
        'date'        => jdate('Y/n/j') . " " . jdate('H:i:s')
        ];

    if (isset($data['image_src']) ) {
        $lastIndex = count( $jsonArray ) - 1;
        $jsonArray[$lastIndex]["image_src"] = $data['image_src'];
        
    }
    print_r($jsonArray[count($jsonArray)-1]);
    file_put_contents($json_url,json_encode($jsonArray,JSON_PRETTY_PRINT));
}

function updateMessage( $username , $text , $message_id  , $url){
    
    require_once "jdf.php";
    $json_url = $url;
    $json = file_get_contents($json_url);
    $jsonArray = json_decode($json,true);
    foreach($jsonArray as $key => $arrayItem){
        
        if ($jsonArray[$key]['id'] == $message_id){
            echo "id foundout";
            $jsonArray[$key]['text_message'] = $text;
            $jsonArray[$key]['date'] = jdate('Y/n/j') . " " . jdate('H:i:s');

            print_r($jsonArray[$key]);
        } 


    }
    echo "<br/>file updated!";
    
    file_put_contents($json_url,json_encode($jsonArray,JSON_PRETTY_PRINT));
    
}

function deleteMessage($message_id, $url){
    $json_url = $url;
    $json = file_get_contents($json_url);
    $jsonArray = json_decode($json,true);
    
    for($i = 0 ; $i < count($jsonArray) ; $i++){
        
        if ($jsonArray[$i]['id'] == $message_id){
            unset($jsonArray[$i]);
        }
    }
    

    echo "message successfully deleted!";
    
    file_put_contents($json_url,json_encode(regroupArray($jsonArray),JSON_PRETTY_PRINT));
    
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

?>