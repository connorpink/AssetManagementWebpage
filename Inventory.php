<!doctype html>
<html lang="en">
<head>

  <?php //function defintitions
  //function defintitions
  include "includes/change.php";
  include "includes/CreateItemField.php";
  include "includes/sendemails.php";
  include "includes/item_count.php";
  include "includes/wh_log.php";
  include "includes/connect.php";
  ?>
  <script src="https://kit.fontawesome.com/3c96de835b.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            $sql = "SELECT DISTINCT Category FROM inventory ORDER BY Category";
            $Categories = mysqli_query($con, $sql);
            while ($newrow = $Categories->fetch_row()) {
                $newrows[] = $newrow;
            }
            echo "
            <script>
            function createDropDown(category){
                document.getElementById(category).scrollIntoView({behavior:'smooth', block: 'center'});
                dropDownMenu = document.getElementById('menucontainer');
                dropDownMenu.style.display = 'none';
               
                }
                
                function sayit() {
                    dropDownMenu = document.getElementById('menucontainer');
                    dropDownMenu.style.display = 'inline';

                }
                
            
            </script>
            ";
            //echo the beginning of the dropdown
            echo "
            <nav>
            <ul>
            <li id = 'dropDownButton' onmousedown='sayit()'><a>Categories</a>
                <ul id = 'menucontainer'>";
            //for each category echo the html to produce that element of the dropdown
            foreach ($newrows as &$Category) {
                $Category = implode($Category);

                if ($Category != null) {
                    echo "
                    <li onClick = \"createDropDown('$Category')\">
                    <a>$Category</a>
                    </li>"; //each element has a javascript function to scroll to view
                } else {
                    echo "
                    <li onClick = \"createDropDown('Uncategorized')\">
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

    <div class = "navigationContainer2">
        <div class="pure-css-nav nav-justified nav-horizontal nav-font-icons small">
          
            <script>
                
            function openCart() {
                var myList = document.getElementById('cartcontainer');
                myList.innerHTML = '';
                
                newForm = $('form').serializeArray();
    
                const ids = [];
                const amount = [];
                const inout = [];
                count = 0;

                for (let i = 0; i < newForm.length; i++) {
                    
                    if (newForm[i].value != ''){

                        ids[count] = newForm[i].name.substring(9);
                        amount[count] = newForm[i].value;
                        inout[count] = amount[count - 1];
                        if(inout[count] == 1){
                            inout[count] = 'In';
                        }
                        else if (inout[count] == 2){
                            inout[count] = 'Out';   
                        }
                        else{
                            inout[count] = 'Neither';
                        }
                        count = count + 1;
                           
                    }
                }
                len = ids.length;
                for(let i = 1; i <= len; i = i + 2){
                    if(inout[i] != 'Neither' && i < len)
                    {
                        ids[i] = ids[i].replace(/([A-Z])/g, ' $1').trim();
                        ids[i] = ids[i].replace(/(_)/g,' ');
                        let listElement = document.createElement('li');
                        let listElementText = document.createTextNode(ids[i]+': '+ amount[i] +' '+ inout[i]);
                        listElement.appendChild(listElementText);
                        document.getElementById('cartcontainer').append(listElement);
                    }
                }
                 
            }

            </script>
            
            <nav>
                <ul>
                    <li id = 'cartButton' onmousedown='openCart()'><a><i class="fas fa-shopping-cart"></i></a>
                        <ul id = 'cartcontainer'>
                    
                        </ul>
                    </li>
                </ul>
            </nav>
           
            
                    
        </div>
    </div>
    <!-- --------------------------------------end of dropdown stuff   -->
    <div class='header'>
        <div class='header-right'>
            <a class='active'>I.T. Inventory</a>
        </div>
        <div>
            <img id='image' src="images/hospital.png" alt="Picture of hospital">
        </div>
    </div>
    
    <script type="text/javascript" src="scripts/validate.js"></script>

    <form action="<?= htmlentities(
        $_SERVER["PHP_SELF"]
    ) ?>"  method="POST"><!--validate form before submition-->
      <fieldset class='content'>
        <?php
        //get all categories from database ordered by category with uncategorized at the bottom
        $con = connect();
        $sql =
            "SELECT DISTINCT Category FROM inventory ORDER BY Category;";
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
        <button id="confirm" name = "confirm" class="button" type="button">Submit</button>
        <script>
            function showCartItems() {
                var myList = document.getElementById('modalCart');
                myList.innerHTML = '';
                
                newForm = $('form').serializeArray();
    
                const ids = [];
                const amount = [];
                const inout = [];
                count = 0;

                for (let i = 0; i < newForm.length; i++) {
                    
                    if (newForm[i].value != ''){

                        ids[count] = newForm[i].name.substring(9);
                        amount[count] = newForm[i].value;
                        inout[count] = amount[count - 1];
                        if(inout[count] == 1){
                            inout[count] = 'In';
                        }
                        else if (inout[count] == 2){
                            inout[count] = 'Out';   
                        }
                        else{
                            inout[count] = 'Neither';
                        }
                        count = count + 1;
                        
                    }
                }
                len = ids.length;
                for(let i = 1; i <= len; i = i + 2){
                    if(inout[i] != 'Neither' && i < len)
                    {
                        ids[i] = ids[i].replace(/([A-Z])/g, ' $1').trim();
                        ids[i] = ids[i].replace(/(_)/g,' ');
                        let listElement = document.createElement('li');
                        let listElementText = document.createTextNode(ids[i]+': '+ amount[i] +' '+ inout[i]);
                        listElement.appendChild(listElementText);
                        document.getElementById('modalCart').append(listElement);
                    }
                }
                
            }
        </script>
        <div class="modal-wrapper">
            <div class="modal">
        
                <div class="modal-content">
                    <p>Cart</p>
                   
                      
                </div>
                    <ul id='modalCart'>
                        
                    </ul>  
                    
                    
                <div class='buttonsContainer'>
                    <div class='buttons'>
                        <button name= 'modal-close' type='button' class="modal-close">Cancel</button>
                        <button id="submit" name = "submit" class="modal-submit" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>

    </fieldset>
    </form>

    <script>



     let modal = document.querySelector('.modal-wrapper');
     let btn = document.getElementById('confirm');
     let close_btn = document.querySelector('.modal-close');


     function display(){
        modal.style.display = 'block';
        showCartItems();
        //openCart();
     }

    //  when the user clicks on X button,close the modal
    close_btn.addEventListener('click',hide);

    // when user clicks anywhere outside the modal, close modal
    window.addEventListener('click',(event)=>{
        if(event.target == modal){
            modal.style.display = 'none';
        }
    });

    function hide(){
        modal.style.display = 'none';
    }
    btn.addEventListener('click',display);
    </script>

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