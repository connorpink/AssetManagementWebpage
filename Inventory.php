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
          if ($amount >= 5) {
            echo"<div class='popup' onclick='myFunction()'>Click me!
            <span class='popuptext' id='myPopup'>Popup text...</span>
          </div>";
          }
          else {
          $sql = "UPDATE inventory SET Count = Count + {$amount} WHERE Item = '{$itemName}';";
          $rs = mysqli_query($con, $sql);
          date_default_timezone_set("America/New_York");
          wh_log("Time: " . date("h:i:sa") ."| Item In: " . $itemName . " Amount: " . $amount . "\n");
          }
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
      echo "<label class='instock'>Instock: ";echo item_count($itemName);echo"</label>";  
    echo "</fieldset>";
    
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
            <nav>
              <ul>
              <li><a href="">Computers</a></li>
              <li><a href="">Monitors</a></li>
                <li>
                  <a href="">PAIN</a>
                  <ul>
                    <li><a href="">lessssss gooooooo</a></li>
                    <li>
                      <a href="">pain</a>
                      <ul>
                        <li><a href="">goooooooo</a></li>
                        <li>
                          <a href="">lesssssssss</a>
                          <ul>
                            <li><a href="">lesssss goooooo</a></li>
                            <li><a href="">lesssss goooooo</a></li>
                            <li><a href="">lesssss goooooo</a></li>
                          </ul>
                        </li>
                        <li><a href="">pain</a></li>
                      </ul>
                    </li>
                    <li><a href="">pains</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
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
    <form action="<?=htmlentities($_SERVER['PHP_SELF']);?>"  method="POST">
      <fieldset class='content'>
        <?php
        
        //get array from database
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
            CreateItemField($item);
          }
        // and then run function with each variable in array

        
        
        ?> 

        <button id="submit" name = "submit" class="button" type="submit">Submit </button>
      </fieldset>
    </form>

    <?php

      

      
      if(isset($_POST['submit'])) {
        foreach ($rows as &$item){
          change($item);
        }
        #echo "<meta http-equiv='refresh' content='0'>";
        session_destroy();
        $_POST = array();
      }
    ?>

    <script>

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

      function AddRemoveAmount(amount,itemName) {
        idnameNumber = 'numberBox'+itemName;
        currentValue = Number(document.getElementById(idnameNumber).value);
        amount = amount + currentValue;
        Number(document.getElementById(idnameNumber).value = amount);

        if (Number(document.getElementById(idnameNumber).value > 5)) {
        
          alert("You have selected greater than 5 items");
        }
      }

      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
    </script> 
</body>