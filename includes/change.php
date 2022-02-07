<?php
//function to check current form data and submit proper changes to database

  function change($itemName){
    if(isset($_POST['numberBox' . $itemName])) {
      if(isset($_POST[$itemName . 'inout'])) {
        //if radio button and number box, have content on submit 
        $radioVal = $_POST[$itemName . "inout"];
        #if radio in is selected
        if ($radioVal == '1'){
          $con = mysqli_connect("localhost","root","sysadm","prhc");
          $amount = $_POST["numberBox" . $itemName];
          //update the database with changes
          $sql = "UPDATE inventory SET Count = Count + {$amount} WHERE Item = '{$itemName}';";
          $rs = mysqli_query($con, $sql);
          date_default_timezone_set("America/New_York");
          //log changes
          wh_log("Time: " . date("h:i:sa") ."| Item In: " . $itemName . " Amount: " . $amount . "\n");
        }
        #else if the radio out button is selected
        else if ($radioVal == '2'){
          $con = mysqli_connect("localhost","root","sysadm","prhc");
          $amount = $_POST["numberBox" . $itemName];
          //update the database with changes
          $sql = "UPDATE inventory SET Count = Count - {$amount} WHERE Item = '{$itemName}';";
          $rs = mysqli_query($con, $sql);
          date_default_timezone_set("America/New_York");
          //log changes
          wh_log("Time: " . date("h:i:sa") . "| Item Out: " . $itemName . " Amount: " . $amount . "\n");
        }
      }
    } 
  }
?>