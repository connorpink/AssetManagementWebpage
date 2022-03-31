<?php
//function to count current number of items
function item_count($item) {
      
    $con = connect();
    $sql = "SELECT Count, Threshold FROM inventory WHERE Item = '{$item}'";
    $rs = mysqli_query($con, $sql);
    $stock = mysqli_fetch_array($rs);
    mysqli_close($con);
    //returns number of items

    $hold = array($stock[0], $stock[1]);

    return $hold;
  }
?>