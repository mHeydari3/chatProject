<?php

$messageLoginIncorrect = "<h3>Username or Password is Incorrect!</h3>";



function generateSuccessfulLogin($username){
    return $messageLoginSuccessfull = "<h1>Welcome Dear " . $username ." </h1>
                            <h2><a href='home.php'>Go to DASHBOARD</a></h2>";
}