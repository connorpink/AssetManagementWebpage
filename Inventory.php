<!doctype html>
<html lang="en">
<head>
  <?php //function defintitions
  //function to check current form data and submit proper changes to database
  function change($itemName){
    if(isset($_POST['numberBox' . $itemName])) {
      if(isset($_POST[$itemName . 'inout'])) {
        $radioVal = $_POST[$itemName . "inout"];
        #if radio in is pressed for Printers
        if ($radioVal == '1'){
          $con = mysqli_connect("localhost","root","sysadm","prhc");
          $amount = $_POST["numberBox" . $itemName];
          $sql = "UPDATE inventory SET Count = Count + {$amount} WHERE Item = '{$itemName}';";
          $rs = mysqli_query($con, $sql);
          date_default_timezone_set("America/New_York");
          wh_log("Time: " . date("h:i:sa") ."| Item In: " . $itemName . " Amount: " . $amount . "\n");
        }
        #else if the radio out button is pressed for Printers
        else if ($radioVal == '2'){
          $con = mysqli_connect("localhost","root","sysadm","prhc");
          $amount = $_POST["numberBox" . $itemName];
          $sql = "UPDATE inventory SET Count = Count - {$amount} WHERE Item = '{$itemName}';";
          $rs = mysqli_query($con, $sql);
          date_default_timezone_set("America/New_York");
          wh_log("Time: " . date("h:i:sa") . "| Item Out: " . $itemName . " Amount: " . $amount . "\n");
        }
      }
    } 
  }
  //log current submit form data to file
  function wh_log($log_msg)
  {
    $log_filename = "log";
    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
    // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
  }

  //create form data fieldset for the item retrieved from database
  function CreateItemField($itemName){
    $itemcount = item_count($itemName);
    $thresh = get_thresh($itemName);
    
    echo "<fieldset class = 'invis'>";
      echo "<p>$itemName</p>";
      echo "<input id='RadioIn$itemName' name='$itemName"."inout' type='radio' value='1'></input>";
      echo "<label class='radioLabel'for='RadioIn$itemName'>In</label>";
      echo "<input id='RadioOut$itemName' name='$itemName"."inout' type='radio' value='2'></input>";
      echo "<label class='radioLabel'for='RadioOut$itemName'>Out</label>";
      echo "<input id='RadioNeither$itemName' name='$itemName"."inout' type='radio' value='3'> </input>";
      echo "<label class='radioLabel'for='RadioNeither$itemName'>Neither</label>";
      echo "<button onclick='AddRemoveAmount(1,\"$itemName\")'class='AddButton'id='button$itemName' type='button'>+1 </button>";
      echo "<button onclick='AddRemoveAmount(2,\"$itemName\")'class='AddButton'id='button$itemName' type='button'>+2 </button>";
      echo "<button onclick='AddRemoveAmount(3,\"$itemName\")'class='AddButton'id='button$itemName' type='button'>+3 </button>";
      echo "<label class='amount' for='amount'>Amount:</label>" ;
      echo "<input type='number' min='0' max='500' id='numberBox$itemName' name='numberBox$itemName'></input>";
      echo "<label class='instock' id='instock$itemName'>Instock: ";echo $itemcount;echo"</label>";  
    echo "</fieldset>";

    if ($itemcount <= $thresh){
      echo "<script> document.getElementById('instock$itemName').style.color = 'red'; </script>";//make red if below target

      if(check_email($itemName) == NULL)
      {
        add_email($itemName);
      }
      emailJosh($itemcount, $thresh, $itemName);

    }
    else if ($itemcount <= ($thresh * 1.5)){//make orange if close to the threshold
      echo "<script> document.getElementById('instock$itemName').style.color = 'orange'; </script>";
    }
    
  }
 
  //function to count current number of items
  function item_count($item) {
      
    $con = mysqli_connect("localhost","root","sysadm","prhc");
    $sql = "SELECT Count FROM inventory WHERE Item = '{$item}'";
    $rs = mysqli_query($con, $sql);
    $dock = mysqli_fetch_array($rs);
    mysqli_close($con);

    return $dock[0];
  }
  
  function get_thresh($item){

    $con = mysqli_connect("localhost","root","sysadm","prhc");
    $sql = "SELECT Threshold FROM inventory WHERE Item = '{$item}'";
    $rs = mysqli_query($con, $sql);
    $thresh = mysqli_fetch_array($rs);
    mysqli_close($con);

    return $thresh[0];

  }

  function check_email($item){

    $con = mysqli_connect("localhost","root","sysadm","prhc");
    $sql = "SELECT StoredDate FROM sendemail WHERE Item = '{$item}'";
    $rs = mysqli_query($con, $sql);
    $email = mysqli_fetch_array($rs);
    mysqli_close($con);

    if($email == NULL){
      return NULL;
    }
    else{
    return $email[0];
    }

  }

  function add_email($item){

    $con = mysqli_connect("localhost","root","sysadm","prhc");
    $sql = "INSERT INTO sendemail (Item, StoredDate) VALUES ('$item', '0000-00-00');";
    $rs = mysqli_query($con, $sql);
    mysqli_close($con);

  }
  ?>
  <script src="https://kit.fontawesome.com/3c96de835b.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="./pure-css-navigation.css" />
  <link rel="stylesheet" href="Yeet.css?v=1.0">
  
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
    </style>
    <?php
    session_start();

    

    ?>

</head>

<body>
<!-- --------------------------------------dropdown stuff   -->

<div class = "navigationContainer">
<div class="pure-css-nav nav-justified nav-horizontal nav-font-icons">

    <?php
    
    $con = mysqli_connect("localhost","root","sysadm","prhc");
    $sql = "SELECT DISTINCT Category FROM inventory ORDER BY Category DESC";
    $Categories = mysqli_query($con, $sql);
    while($newrow = $Categories->fetch_row())
          {
          $newrows[] = $newrow;
          }

    echo "
    <nav>
    <ul>
    <li><a>Categories</a>
      <ul>";
      
      foreach ($newrows as &$Category){
        $Category = implode($Category);
        
        if ($Category != null){
          echo "
            <li onclick = \"document.getElementById('$Category').scrollIntoView({behavior:'smooth', block: 'center'});\">
              <a>$Category</a>
            </li>";
        }
        else {
          echo "
            <li onclick = \"document.getElementById('Uncategorized').scrollIntoView({behavior:'smooth', block: 'center'});\">
              <a>Uncategorized</a>
            </li>";
        }
        }
              
        echo "
            </ul>
          </li>
          </ul>
          </nav>
      ";
    ?>
            
          </div>

  </div>
        <!-- --------------------------------------dropdown stuff   -->
    <div class='header'>

        <a class='logo'>PRHC</a>
        <div class='header-right'>
          <a class='active'>I.T. Inventory</a>
        </div>
        <div>
          <img src="hospital.png" alt="Picture of hospital">
          
      </div>
    </div>

    <script>
      function validate(form) {
        NumberBoxes = document.querySelectorAll('input[type=number]');
        
          for (box of NumberBoxes){
            if(box.valueAsNumber >= 5) {
              if (!confirm('You picked '+box.valueAsNumber+' items for '+box.name+', are you sure?')){ return false;} 
            } 
          }
      }
      </script>

    <form action="<?=htmlentities($_SERVER['PHP_SELF']);?>"  method="POST" onsubmit="return validate(this);">
      <fieldset class='content'>
        <?php
        function emailJosh($count, $threshold, $item) {
         //get array from database
          $con = mysqli_connect("localhost","root","sysadm","prhc");
          $sql = "SELECT Item FROM inventory;";
          $result = mysqli_query($con, $sql);

        //Date Time
        $Yes = "SELECT StoredDate FROM sendemail WHERE Item = '$item';";
        $dateResult = mysqli_query($con, $Yes);
        $dateResult = mysqli_fetch_array($dateResult);

        $currentDate = date("Y-m-d ");
        $seconds = abs(strtotime($currentDate) - strtotime($dateResult[0]));
        if($seconds >= 259200){
          $newDate = "UPDATE sendemail SET StoredDate = '$currentDate' WHERE Item = '$item';";
          $resultDate = mysqli_query($con, $newDate);
          if ($count < $threshold) {
         mail('connor.millson@gmail.com', 'Under Threshold Item Inventory', $item .': Currently at '. $count .', under threshold of '.$threshold, 'From: connor.millson@gmail.com'); 
          }
          } else {
          }
          mysqli_close($con);

        }

        
          $con = mysqli_connect("localhost","root","sysadm","prhc");
          $sql = "SELECT DISTINCT Category FROM inventory ORDER BY Category DESC;";
          $result = mysqli_query($con, $sql);

          mysqli_close($con);

          while($row = $result->fetch_row())
          {
          $rows[] = $row;
          }

          foreach ($rows as &$newItem){
            $newItem = implode($newItem);
            
            if ($newItem != ""){
              echo "<h1 id='$newItem'> $newItem </h1>";
              $con = mysqli_connect("localhost","root","sysadm","prhc");
              $sql = "SELECT Item FROM inventory WHERE Category='$newItem';";
              $categoryResult2 = mysqli_query($con, $sql);

              mysqli_close($con);
              $newItemrows2 = [];
              while($newItemrow2 = $categoryResult2->fetch_row())
              {
                $newItemrows2[] = $newItemrow2;
              }
              foreach($newItemrows2 as &$rowitem2){
                $rowitem2 = implode($rowitem2);

                CreateItemField($rowitem2);
              }
            }
            else{
              echo "<h1 id='Uncategorized'> Uncategorized </h1>";  
              $con = mysqli_connect("localhost","root","sysadm","prhc");
              $sql = "SELECT Item FROM inventory WHERE Category=''";
              $categoryResult = mysqli_query($con, $sql);

              mysqli_close($con);

              while($newItemrow = $categoryResult->fetch_row())
              {
                $newItemrows[] = $newItemrow;
              }
              foreach($newItemrows as &$rowitem){
                $rowitem = implode($rowitem);

                CreateItemField($rowitem);
              }
            }
            
          }
        // and then run function with each variable in array

        
        
        ?> 

        <button id="submit" name = "submit" class="button" type="submit">Submit </button>
      </fieldset>
    </form>

    <?php
      if(isset($_POST['submit'])) {
          $con = mysqli_connect("localhost","root","sysadm","prhc");
          $sql = "SELECT Item FROM inventory;";
          $result = mysqli_query($con, $sql);

          mysqli_close($con);

          while($row = $result->fetch_row())
          {
            $rows[] = $row;
          }
          foreach ($rows as &$item){
            $item = implode($item);
            
            change($item);

          }

        echo "<meta http-equiv='refresh' content='0'>";
        session_destroy();
        $_POST = array();

      }
    ?>

    <script>
// Refresh page on 3 min inactivity
let time = new Date().getTime();
const setActivityTime = (e) => {
  time = new Date().getTime();
}
document.body.addEventListener("mousemove", setActivityTime);
document.body.addEventListener("keypress", setActivityTime);

const refresh = () => {
  if (new Date().getTime() - time >= 180000) {
    window.location.reload(true);
  } else {
    setTimeout(refresh, 10000);
  }
}

setTimeout(refresh, 10000);

  // Make buttons change value in the textbox
      function AddRemoveAmount(amount,itemName) {
        idnameNumber = 'numberBox'+itemName;
        currentValue = Number(document.getElementById(idnameNumber).value);
        amount = amount + currentValue;
        Number(document.getElementById(idnameNumber).value = amount);
      }

      // Remove form resubmission data on refresh

      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
    </script> 
</body>