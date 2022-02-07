<?php
//function to count current number of items
function item_count($item) {
      
    $con = mysqli_connect("localhost","root","sysadm","prhc");
    $sql = "SELECT Count FROM inventory WHERE Item = '{$item}'";
    $rs = mysqli_query($con, $sql);
    $stock = mysqli_fetch_array($rs);
    mysqli_close($con);
    //returns number of items
    return $stock[0];
  }
?>