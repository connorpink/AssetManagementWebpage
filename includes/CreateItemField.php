<?php
//create form data fieldset for the item retrieved from database
function CreateItemField($itemName){
    //run item_count function
    $itemcount = item_count($itemName);
    //get items threshold
    
    echo "<fieldset class='itemFieldset'>";
      echo "<p>$itemName</p>";
      //parse string (replace spaces with underscore, " with nothing and ' with nothing for accessible ids) here 
      $underScoreItemName = str_replace(' ', '_', $itemName);
      $underScoreItemName = str_replace('"', '', $underScoreItemName);
      $underScoreItemName = str_replace('\'', '', $underScoreItemName);

      echo "<div class='radioDiv'>";
      echo "<input id='RadioIn$underScoreItemName' name='$underScoreItemName"."inout' type='radio' value='1'></input>";
      echo "<label class='radioLabel'for='RadioIn$underScoreItemName'>In</label>";
      echo "<input id='RadioOut$underScoreItemName' name='$underScoreItemName"."inout' type='radio' value='2'></input>";
      echo "<label class='radioLabel'for='RadioOut$underScoreItemName'>Out</label>";
      echo "<input id='RadioNeither$underScoreItemName' name='$underScoreItemName"."inout' type='radio' value='3'> </input>";
      echo "<label class='radioLabel'for='RadioNeither$underScoreItemName'>Neither</label>";
      echo "</div>";
      //echo "<br>";
      //button with function call on press
      echo "<div class='centerDiv'>";
      echo "<div class='buttonDiv'>";
      echo "<button onclick='AddRemoveAmount(1,\"$underScoreItemName\")'class='AddButton'id='button$underScoreItemName' type='button'>+1</button>";
      echo "<button onclick='AddRemoveAmount(2,\"$underScoreItemName\")'class='AddButton'id='button$underScoreItemName' type='button'>+2</button>";
      echo "<button onclick='AddRemoveAmount(3,\"$underScoreItemName\")'class='AddButton'id='button$underScoreItemName' type='button'>+3</button>";
      echo "</div>";
      echo "<div class='amountDiv'>";
      echo "<label class='amount' for='amount'>Amount:</label>" ;
      echo "<input class='amountInput'type='number' min='0' max='500' id='numberBox$underScoreItemName' name='numberBox$underScoreItemName'></input>";
      echo "</div>";
      //insctock tag with item count
      echo "<label class='instock' id='instock$underScoreItemName'>Instock: ";echo $itemcount[0];echo"</label>";  
      echo "</div>";

      echo "</fieldset>";

    if ($itemcount[0] <= $itemcount[1]){
      //if item count is less than the threshold change color to red
      echo "<script> document.getElementById('instock$underScoreItemName').style.color = 'red'; </script>";//make red if below target
      //if item count is less than the threshold send appropriate email to notify such
      sendemails($itemcount[0], $itemcount[1], $itemName);

    }
    //else if item count is within 1.5 of the treshold make color orange to signal low stock
    else if ($itemcount[0] <= ($itemcount[1] * 1.5)){//make orange if close to the threshold
      echo "<script> document.getElementById('instock$underScoreItemName').style.color = 'orange'; </script>";
    }
    
  }
?>