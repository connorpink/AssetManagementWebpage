<?php
//function to check current form data and submit proper changes to database

  function change($itemName){
    //parse string (replace spaces with underscore) here //
    $underScoreItemName = str_replace(' ', '_', $itemName);
    $underScoreItemName = str_replace('"', '', $underScoreItemName);
    $underScoreItemName = str_replace('\'', '', $underScoreItemName);
    if(isset($_POST['numberBox' . $underScoreItemName])) {
      if(isset($_POST[$underScoreItemName . 'inout'])) {
        //if radio button and number box, have content on submit 
        $radioVal = $_POST[$underScoreItemName . "inout"];
        #if radio in is selected
        if ($radioVal == '1'){
          $con = connect();
          $amount = $_POST["numberBox" . $underScoreItemName];
          //update the database with changes
          $sql = "UPDATE inventory SET Count = Count + {$amount} WHERE Item = '{$itemName}';";
          $rs = mysqli_query($con, $sql);
          date_default_timezone_set("America/New_York");
          //log changes
          wh_log("Time: " . date("h:i:sa") ."| Item In: " . $itemName . " Amount: " . $amount . "\n");
        }
        #else if the radio out button is selected
        else if ($radioVal == '2'){
          $con = connect();
          $amount = $_POST["numberBox" . $underScoreItemName];
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