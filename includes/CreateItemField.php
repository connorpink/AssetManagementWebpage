<?php
//create form data fieldset for the item retrieved from database
function CreateItemField($itemName){
    //run item_count function
    $itemcount = item_count($itemName);
    //get items threshold
    $thresh = get_thresh($itemName);
    
    echo "<fieldset class = 'invis'>";
      echo "<p>$itemName</p>";
      //parse string (replace spaces with underscore) here //
      $underScoreItemName = str_replace(' ', '_', $itemName);

      echo "<input id='RadioIn$underScoreItemName' name='$underScoreItemName"."inout' type='radio' value='1'></input>";
      echo "<label class='radioLabel'for='RadioIn$underScoreItemName'>In</label>";
      echo "<input id='RadioOut$underScoreItemName' name='$underScoreItemName"."inout' type='radio' value='2'></input>";
      echo "<label class='radioLabel'for='RadioOut$underScoreItemName'>Out</label>";
      echo "<input id='RadioNeither$underScoreItemName' name='$underScoreItemName"."inout' type='radio' value='3'> </input>";
      echo "<label class='radioLabel'for='RadioNeither$underScoreItemName'>Neither</label>";
      //button with function call on press
      echo "<button onclick='AddRemoveAmount(1,\"$underScoreItemName\")'class='AddButton'id='button$underScoreItemName' type='button'>+1 </button>";
      echo "<button onclick='AddRemoveAmount(2,\"$underScoreItemName\")'class='AddButton'id='button$underScoreItemName' type='button'>+2 </button>";
      echo "<button onclick='AddRemoveAmount(3,\"$underScoreItemName\")'class='AddButton'id='button$underScoreItemName' type='button'>+3 </button>";
      echo "<label class='amount' for='amount'>Amount:</label>" ;
      echo "<input type='number' min='0' max='500' id='numberBox$underScoreItemName' name='numberBox$underScoreItemName'></input>";
      //insctock tag with item count
      echo "<label class='instock' id='instock$underScoreItemName'>Instock: ";echo $itemcount;echo"</label>";  
    echo "</fieldset>";

    if ($itemcount <= $thresh){
      //if item count is less than the threshold change color to red
      echo "<script> document.getElementById('instock$underScoreItemName').style.color = 'red'; </script>";//make red if below target
      //if item count is less than the threshold send appropriate email to notify such
      if(check_email($itemName) == NULL)
      {
        add_email($itemName);
      }
      sendemails($itemcount, $thresh, $itemName);

    }
    //else if item count is within 1.5 of the treshold make color orange to signal low stock
    else if ($itemcount <= ($thresh * 1.5)){//make orange if close to the threshold
      echo "<script> document.getElementById('instock$underScoreItemName').style.color = 'orange'; </script>";
    }
    
  }
?>