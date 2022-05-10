<?php

include "../public/home.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery.scrollto@2.1.3/jquery.scrollTo.min.js"></script>
    <link rel="stylesheet" href="../styles/home.css">
    <title>HomePage </title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Chat System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="home.php?logout=true">Logout</a>
      </li>

    </ul>
    </ul>

  </div>
</nav>


    <input type="hidden" id="sender" value="<?=$_SESSION['username']?>" />
    <input type="hidden" id="username" value="<?=$_SESSION['username']?>" />
    <input type="hidden" id="permission" value="<?=$_SESSION['permission']??"";?>" />

    <input type="hidden" id="msgEditID">
    <div class="page-content page-container" id="page-content">
            <div class="padding" >
                <div class="row container d-flex justify-content-center" style="margin-left: 3.6em;">
                    <div class="col-md-6">
                        <div class="card card-bordered">
                            <div class="card-header">
                                <h4 class="card-title"><strong>Chat</strong></h4> <a class="btn btn-xs btn-secondary" href="#" data-abc="true">Let's Chat App</a>
                            </div>
                            <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:400px !important;">
                                
                            </div>
                            <div class="publisher bt-1 border-light"> 
                                <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="..."> 
                                <input class="publisher-input" type="text" placeholder="Write something" id="userinput">
                                <span id="chCounter">0</span>  
                                <input id="file" type="file" accept=".png,.jpg,.gif" style="display:none;">
                                <span class="publisher-btn file-group" id="file-select" onclick="$('#file').trigger('click');"> 
                                    <i class="fa fa-paperclip file-browser"></i> 
                                </span> 
                            <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a>
                            <a class="publisher-btn text-info " href="#" data-abc="true" id="send" ><i class="fa fa-paper-plane"></i><div class="edit-submit-icon-shadow "></div></a> 
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



<script src="../js/home_js.js"></script>

</body>
</html>