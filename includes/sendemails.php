<?php
// Send inventory notice emails to Josh and James
  function sendemails($count, $threshold, $item) {

      //get array from database
      $con = connect();
      $sql = "SELECT Item FROM inventory;";
      $result = mysqli_query($con, $sql);

    //Get date for item
    $Yes = "SELECT StoredDate FROM sendemail WHERE Item = '$item';";
    $dateResult = mysqli_query($con, $Yes);
    $dateResult = mysqli_fetch_array($dateResult);

    if($dateResult[0] == NULL)
      {

        // Get current date and determine the time between stored date and current date
        $currentDate = date("Y-m-d ");
        $seconds = abs(strtotime($currentDate) - strtotime($dateResult[0]));
        // If time between dates is over 3 days, send emails and replace stored date with current date
        if($seconds >= 259200){
          $newDate = "INSERT INTO sendemail (Item, StoredDate) VALUES ('$item', '$currentDate');";
          $resultDate = mysqli_query($con, $newDate);
          if ($count < $threshold) {
            mail('jleclerc@prhc.on.ca', 'Under Threshold Item Inventory', $item .': Currently at '. $count .', under threshold of '.$threshold, 'From: inventory@prhc.on.ca'); 
            mail('jdeane@prhc.on.ca', 'Under Threshold Item Inventory', $item .': Currently at '. $count .', under threshold of '.$threshold, 'From: inventory@prhc.on.ca');
            }
          } 
          mysqli_close($con);

      }

      else{

          // Get current date and determine the time between stored date and current date
          $currentDate = date("Y-m-d ");
          $seconds = abs(strtotime($currentDate) - strtotime($dateResult[0]));
          // If time between dates is over 3 days, send emails and replace stored date with current date
          if($seconds >= 259200){
            $newDate = "UPDATE sendemail SET StoredDate = '$currentDate' WHERE Item = '$item';";
            $resultDate = mysqli_query($con, $newDate);
            if ($count < $threshold) {
              mail('jleclerc@prhc.on.ca', 'Under Threshold Item Inventory', $item .': Currently at '. $count .', under threshold of '.$threshold, 'From: inventory@prhc.on.ca'); 
              mail('jdeane@prhc.on.ca', 'Under Threshold Item Inventory', $item .': Currently at '. $count .', under threshold of '.$threshold, 'From: inventory@prhc.on.ca');
              }
            } 
            mysqli_close($con);
      }

    









    }
?>