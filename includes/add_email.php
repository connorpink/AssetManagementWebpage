<?php
//Adds a record to the sendemail table
function add_email($item){

    //Inserts record into the table
    $con = connect();
    $sql = "INSERT INTO sendemail (Item, StoredDate) VALUES ('$item', '0000-00-00');";
    $rs = mysqli_query($con, $sql);
    mysqli_close($con);

  }
  ?>