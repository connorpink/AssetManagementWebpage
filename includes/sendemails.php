<?php
// Send inventory notice emails to Josh and James
  function sendemails($count, $threshold, $item) {
    include "includes/emailList.php";

      //get array from database
      $con = connect();
      $sql = "SELECT Item FROM inventory;";
      $result = mysqli_query($con, $sql);

    //Get date for item
    $Yes = "SELECT StoredDate FROM sendemail WHERE Item = '$item';";
    $dateResult = mysqli_query($con, $Yes);
    $dateResult = mysqli_fetch_array($dateResult);

    if($dateResult == null)
      {
        // Get current date and determine the time between stored date and current date
        $currentDate = date("Y-m-d ");

        $newDate = "INSERT INTO sendemail (Item, StoredDate) VALUES ('$item', '$currentDate');";
        $resultDate = mysqli_query($con, $newDate);
        if ($count <= $threshold) {
          foreach ($emailList as &$email){
            mail($email, 'Under Threshold Item Inventory', $item .': Currently at '. $count .', under threshold of '.$threshold, 'From: inventory@prhc.on.ca'); 
          }
        mysqli_close($con);

      }
    }

    else{

        // Get current date and determine the time between stored date and current date
        $currentDate = date("Y-m-d ");
        $seconds = abs(strtotime($currentDate) - strtotime($dateResult[0]));
        // If time between dates is over 3 days, send emails and replace stored date with current date
        if($seconds >= 259200){
          $newDate = "UPDATE sendemail SET StoredDate = '$currentDate' WHERE Item = '$item';";
          $resultDate = mysqli_query($con, $newDate);
          if ($count <= $threshold) {
            foreach ($emailList as &$email){
              mail($email, 'Under Threshold Item Inventory', $item .': Currently at '. $count .', under threshold of '.$threshold, 'From: inventory@prhc.on.ca'); 
            }
          }
        } 
          mysqli_close($con);
      }
    }
?>