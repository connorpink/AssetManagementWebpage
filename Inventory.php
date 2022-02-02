<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="Yeet.css?v=1.0">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
    </style>
    <?php
    session_start();
    //prompt function
    

  //program
  


    function item_count($item) {
      
      $con = mysqli_connect("localhost","root","sysadm","prhc");
      $sql = "SELECT Count FROM inventory WHERE Item = '{$item}'";
      $rs = mysqli_query($con, $sql);
      $dock = mysqli_fetch_array($rs);
      mysqli_close($con);

      return $dock[0];
    }

    ?>

</head>

<body>
    <div class='header'>
        <a class='logo'>PRHC</a>
        <div class='header-right'>
        <a class='active'>I.T. Inventory</a>
        </div>
        <div><img src="hospital.png" alt="Picture of hospital"></div>
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

        
        function CreateItemField($itemName){
          echo "<fieldset>";
            echo "<p>$itemName</p>";
            echo "<input id='RadioIn$itemName' name='$itemName"."inout' type='radio' value='1'></input>";
            echo "<label class='radioLabel'for='RadioIn$itemName'>In</label>";
            echo "<input id='RadioOut$itemName' name='$itemName"."inout' type='radio' value='2'></input>";
            echo "<label class='radioLabel'for='RadioOut$itemName'>Out</label>";
            echo "<input id='RadioNeither$itemName' name='$itemName"."inout' type='radio' value='3'> </input>";
            echo "<label class='radioLabel'for='RadioNeither$itemName'>Neither</label>";
            echo "<button onclick='AddRemoveAmount(1,\"$itemName\")'class='AddButton'id='button$itemName' type='button'>+1 </button>";
            echo "<button onclick='AddRemoveAmount(2,\"$itemName\")'class='AddButton'id='button$itemName' type='button'>+2 </button>";
            echo "<button onclick='AddRemoveAmount(5,\"$itemName\")'class='AddButton'id='button$itemName' type='button'>+5 </button>";
            echo "<label class='amount' for='amount'>Amount:</label>" ;
            echo "<input type='number' min='0' max='500' id='numberBox$itemName' name='numberBox$itemName'></input>";
            echo "<label class='instock'>Instock: ";echo item_count($itemName);echo"</label>";  
          echo "</fieldset>";
          
        }
        ?> 

        <button id="submit" name = "submit" class="button" type="submit">Submit </button>
      </fieldset>
    </form>

    <?php

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
      if(isset($_POST['submit'])) {
        foreach ($rows as &$item){
          change($item);
        }
        echo "<meta http-equiv='refresh' content='0'>";
        session_destroy();
        $_POST = array();
      }
    ?>

    <script>

      function AddRemoveAmount(amount,itemName) {
        idnameNumber = 'numberBox'+itemName;
        currentValue = Number(document.getElementById(idnameNumber).value);
        amount = amount + currentValue;
        Number(document.getElementById(idnameNumber).value = amount);
      }

      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
    </script> 
</body>