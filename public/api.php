<?php
require_once "../helper/functions.php";
if (isset($_POST) && isset($_POST['username'])){
    
    if (isset( $_POST['message_id']) )
        updateMessage($_POST['username'],$_POST['text'], $_POST['message_id'] );
    else
        InsertNewMessage($_POST );
    
}

else if(isset($_GET) && isset($_GET['showmessage'])){
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Content-Type: application/json; charset=utf-8");
    echo returnJsonContentMessages();

}
else if(isset($_GET) && isset($_GET['deleteMSG'])){
    extract($_GET);
    deleteMessage($message_id );
}