
<!doctype html>
<html lang="en">
    <head>
        <title>Chart View</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <style>
            body{
                background-color: #27323b;  
            }
            .chartContainer{
                display:flex;                
                align-content:center;
                justify-content:center;
                
                
                width:99vw;
                height: 120vh;
            
            }
            .chartContainer text {
                fill: #dce0e6 !important;
            }
        </style>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
    </head>
    <body>
        <?php
            include "includes/connect.php";
            if (isset($_GET['category'])){
                $category = $_GET["category"];
            }
        ?>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" >PRHC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="./inventory.php" class="nav-link">Inventory</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class='dropdown-item' href='./view.php'>All</a></li>
                            <?php
                                $con = connect();
                                $sql = "SELECT DISTINCT Category FROM inventory WHERE Category <> '' ORDER BY Category";
                                $result = mysqli_query($con, $sql);
                                mysqli_close($con);
                                $rows = [];
                
                                while($row = mysqli_fetch_row($result)) {
                                    echo "<li><a class='dropdown-item' href='?category={$row[0]}'>$row[0]</a></li>";
                                }

                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        

        <div class="chartContainer">
            <div id="barchart_material" style="width: 100%; height: 100%;"></div>
        </div>
        
        <p id='data' style="color:transparent"><?php
                
                $con = connect();
                if (isset($_GET['category'])){
                    $sql = " SELECT Item, Count, Category, Threshold  FROM inventory WHERE Category = '$category' ORDER BY Category";
                }
                else{
                    $sql = "SELECT Item, Count, Category, Threshold  FROM inventory ORDER BY Category";
                }
                $result = mysqli_query($con, $sql);
                mysqli_close($con);
                $rows = [];

                while($row = mysqli_fetch_row($result)) {
                    echo   $row[0] ;
                    echo  ", ";
                    echo $row[1] ;
                    echo  ", ";
                    echo $row[3] ;
                    echo "~";
                }

            ?></p>
        <script type="text/javascript" src="scripts/loader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>

