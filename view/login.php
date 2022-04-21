<?php

include "../public/login.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <title>Document</title>
</head>
<body>
<section class="w-100 vh-100">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="px-5 ms-xl-4">
                <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                <span class="h1 fw-bold mb-0">Logo</span>
            </div>
            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

            <?php 
            if (isset($_SESSION['username'])){
                echo generateSuccessfulLogin($_SESSION['username']);
            }
            else if (isset($isLogined) && $isLogined == 1){
                $_SESSION['username'] = $username;
                echo generateSuccessfulLogin($username);
                
                
            }else if (isset($loginIncorrect) && $loginIncorrect == 1 ){
                echo $messageLoginIncorrect;
            }else{ // show login form

            
            
            ?>
                <form method="post" action="" style="width: 23rem;" >

                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                    <div class="form-outline mb-4">
                        <input type="text" id="username" name="username" class="form-control form-control-lg" />
                        <label class="form-label" for="username">Username</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="password">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                        <input name="submit" class="btn btn-info btn-lg btn-block" type="submit" value="Login">
                    </div>

                    
                    <p>Don't have an account? <a href="signup.php" class="link-info">Register here</a></p>

                </form>


            <?php
            
            }

            ?>
            </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
            <img class="w-100 vh-100" style="object-fit: cover; " src="../images/bg.jpg" alt="Login image" >

        </div>
    </div>
</div>
</section>




</body>
</html>