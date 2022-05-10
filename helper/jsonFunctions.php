<?php

require_once "db.php";
if(!defined("config")){
    define( "config" , require __DIR__ . '/../config.php');
}

function deleteMessageJSON($message_id){
    $json_url = config['STORAGE']['JSON_FILE_PATH'];
    $json = file_get_contents($json_url);
    $jsonArray = json_decode($json,true);
    
    for($i = 0 ; $i < count($jsonArray) ; $i++){
        
        if ($jsonArray[$i]['id'] == $message_id){
            unset($jsonArray[$i]);
        }
    }
    

    echo "message successfully deleted!";
    
    $result = file_put_contents($json_url,json_encode(regroupArray($jsonArray),JSON_PRETTY_PRINT));
    return $result;
}

function returnMessageJSON(){
    $json_url = config['STORAGE']['JSON_FILE_PATH'];
    $json = file_get_contents($json_url);
    
    return $json;
}

function insertNewMessageJSON($username , $text , $data){
    $json_url = config['STORAGE']['JSON_FILE_PATH'];
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

function updateMessageJSON($message_id ,$text ){
    require_once "jdf.php";
    $json_url = config['STORAGE']['JSON_FILE_PATH'];
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

function checkUserinJSON($username , $password){
        
    $json_url = config['STORAGE']['USERS_FILE_PATH'];
    $json = file_get_contents($json_url);
    $jsonArray = json_decode($json,true);
    
    foreach($jsonArray as $item){
        if(isset($item['username']) && isset($item['password']) &&
           $username == $item['username'] && 
           $password == $item['password']
          ){
              return $item;
          }
    }
    return false;
}