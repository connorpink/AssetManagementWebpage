<?php

function connect(){

    include 'password.php';
    $con = mysqli_connect("localhost", "root", $pass, "prhc");
    return $con;

}


?>