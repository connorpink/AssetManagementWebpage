<?php 
//Function to check when the last email was sent
function check_email($item){

    //Connects to database and gets when the email was stored
    $con = mysqli_connect("localhost","root","sysadm","prhc");
    $sql = "SELECT StoredDate FROM sendemail WHERE Item = '{$item}'";
    $rs = mysqli_query($con, $sql);
    $email = mysqli_fetch_array($rs);
    mysqli_close($con);

    //Checks if an email has ever been sent
    if($email == NULL){
      return NULL;
    }
    else{
    return $email[0];
    }

  }
?>