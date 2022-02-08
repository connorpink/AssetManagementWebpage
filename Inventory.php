<!doctype html>
<html lang="en">
<head>

  <?php //function defintitions
  //function defintitions
  include "includes/change.php";
  include "includes/add_email.php";
  include "includes/check_email.php";
  include "includes/CreateItemField.php";
  include "includes/sendemails.php";
  include "includes/get_thresh.php";
  include "includes/item_count.php";
  include "includes/wh_log.php";
  include "includes/connect.php";
  ?>
  <script src="https://kit.fontawesome.com/3c96de835b.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="style/pure-css-navigation.css" />
  <link rel="stylesheet" href="style/Yeet.css?v=1.0">
  
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
    </style>
    <?php session_start(); ?>

</head>

<body>
<!-- --------------------------------------dropdown stuff   -->
    <div class = "navigationContainer">
        <div class="pure-css-nav nav-justified nav-horizontal nav-font-icons">
            <?php
            //query the categories from the database
            $con = connect();
            $sql = "SELECT DISTINCT Category FROM inventory ORDER BY Category DESC";
            $Categories = mysqli_query($con, $sql);
            while ($newrow = $Categories->fetch_row()) {
                $newrows[] = $newrow;
            }
            //echo the beginning of the dropdown
            echo "
            <nav>
            <ul>
            <li><a>Categories</a>
                <ul>";
            //for each category echo the html to produce that element of the dropdown
            foreach ($newrows as &$Category) {
                $Category = implode($Category);

                if ($Category != null) {
                    echo "
                    <li onclick = \"document.getElementById('$Category').scrollIntoView({behavior:'smooth', block: 'center'});\">
                    <a>$Category</a>
                    </li>"; //each element has a javascript function to scroll to view
                } else {
                    echo "
                    <li onclick = \"document.getElementById('Uncategorized').scrollIntoView({behavior:'smooth', block: 'center'});\">
                    <a>Uncategorized</a>
                    </li>"; //the uncategorized items get put at the bottom
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
    <!-- --------------------------------------end of dropdown stuff   -->
    <div class='header'>
        <a class='logo'>PRHC</a>
        <div class='header-right'>
            <a class='active'>I.T. Inventory</a>
        </div>
        <div>
            <img src="images/hospital.png" alt="Picture of hospital">
        </div>
    </div>
    
    <script type="text/javascript" src="scripts/validate.js"></script>

    <form action="<?= htmlentities(
        $_SERVER["PHP_SELF"]
    ) ?>"  method="POST" onsubmit="return validate(this);"><!--validate form before submition-->
      <fieldset class='content'>
        <?php
        //get all categories from database ordered by category with uncategorized at the bottom
        $con = connect();
        $sql =
            "SELECT DISTINCT Category FROM inventory ORDER BY Category DESC;";
        $result = mysqli_query($con, $sql);

        mysqli_close($con);

        while ($row = $result->fetch_row()) {
            $rows[] = $row;
        }
        //for each category in the database
        foreach ($rows as &$newItem) {
            $newItem = implode($newItem);
            //if category is not null meaning not uncategorized
            if ($newItem != "") {
                //create the header and then create all the itemfields which follow it
                echo "<h1 id='$newItem'> $newItem </h1>";
                $con = connect();
                $sql = "SELECT Item FROM inventory WHERE Category='$newItem';";
                $categoryResult2 = mysqli_query($con, $sql);

                mysqli_close($con);
                $newItemrows2 = [];
                while ($newItemrow2 = $categoryResult2->fetch_row()) {
                    $newItemrows2[] = $newItemrow2;
                }
                foreach ($newItemrows2 as &$rowitem2) {
                    $rowitem2 = implode($rowitem2);
                    CreateItemField($rowitem2);
                }
            }
            //otherwise the category is blank and therefore uncategorized
            else {
                //create the header and then create all the itemfields which follow it

                echo "<h1 id='Uncategorized'> Uncategorized </h1>";
                $con = connect();
                $sql = "SELECT Item FROM inventory WHERE Category=''";
                $categoryResult = mysqli_query($con, $sql);

                mysqli_close($con);

                while ($newItemrow = $categoryResult->fetch_row()) {
                    $newItemrows[] = $newItemrow;
                }
                foreach ($newItemrows as &$rowitem) {
                    $rowitem = implode($rowitem);
                    CreateItemField($rowitem);
                }
            }
        }
        ?> 

        <button id="submit" name = "submit" class="button" type="submit">Submit </button>
      </fieldset>
    </form>

    <?php //when form is submit run the change function on all items in the database
    if (isset($_POST["submit"])) {
        $con = connect();
        $sql = "SELECT Item FROM inventory;";
        $result = mysqli_query($con, $sql);

        mysqli_close($con);

        while ($row = $result->fetch_row()) {
            $rows[] = $row;
        }
        foreach ($rows as &$item) {
            $item = implode($item);
            //for each item run change function witch detects and submits changes.
            change($item);
        }
        //refresh page
        echo "<meta http-equiv='refresh' content='0'>"; //refresh the page
        session_destroy();
        $_POST = [];
    } ?>
    <script type="text/javascript" src="scripts/refresh.js"></script>

</body>
