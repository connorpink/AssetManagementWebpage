<?php
//Function to check if an item is below the threshold
function get_thresh($item){
    
    //Connects to database and gets the threshold for the specified item and returns it
    $con = mysqli_connect("localhost","root","sysadm","prhc");
    $sql = "SELECT Threshold FROM inventory WHERE Item = '{$item}'";
    $rs = mysqli_query($con, $sql);
    $thresh = mysqli_fetch_array($rs);
    mysqli_close($con);

    return $thresh[0];

  }
?>