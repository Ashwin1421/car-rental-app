<!DOCTYPE html>
<html>

<head>
    <title>EZRide</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../../public/images/shortcut_icon.png">
    <link rel="stylesheet" href="../css/Footer-with-social-icons.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/viewcars.css">
    <script type="text/javascript" src="../js/viewcars.js"></script>
</head>

<body>
<?php
    session_start();
?>

<div class="content">
    <!-- Navigation -->
    <nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="index.php" class="navbar-brand">EZRide</a>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="../../index.php">Home
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>
        </ul>
        <form class="navbar-form navbar-left">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </form>

        <ul class="nav navbar-nav navbar-right">
            <li>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <?php
                    if(isset($_SESSION["username"])){
                        echo "Welcome, ".$_SESSION['fname'];
                    }
                ?>
                <span class="glyphicon glyphicon-user"></span>
            </a>
            <ul id="btn-list" class="dropdown-menu">
                <li>
                    <?php if(!isset($_SESSION["username"])){ ?>
                        <a id="sign-up" href="assets/views/register.html">
                        Sign-Up
                        </a>
                    <?php }?>
                </li>
                <li>
                    <?php if(!isset($_SESSION["username"])){ ?>
                        <a id="log-in" href="assets/views/login.html">
                        Login
                        <span class="glyphicon glyphicon-log-in"></span>
                        </a>
                    <?php }?>
                </li>
                <li>
                    <?php if(isset($_SESSION["username"])){ ?>
                        <a id="order-list" href="#">My Orders
                        </a>
                    <?php }?>
                </li>
                <li>
                    <?php if(isset($_SESSION["username"])){ ?>
                        <a id="log-out" href="../php/logout.php">Logout
                        <span class="glyphicon glyphicon-log-out"></span>
                        </a>
                    <?php }?>
                </li>
            </ul>
            </li>
        </ul>
        <!-- Order cart controller -->
        <?php if(isset($_SESSION["username"])){ ?>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="">
                    My Cart
                    <span class="glyphicon glyphicon glyphicon-shopping-cart"></span>
                    </a>
                </li>
            </ul>
        <?php }?>
        <!-- Order cart controller -->

        <!-- admin controller -->
        <?php if(isset($_SESSION["admin"])){ if($_SESSION["admin"] == 1){ ?>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="">
                    Admin
                    <span class="glyphicon glyphicon glyphicon-cog"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="">
                                Car List
                            </a>
                        </li>
                        <li>
                            <a href="addcarform.php">
                                Add new cars
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        <?php }}?>
        <!-- admin controller -->


    </div>
    </nav>

    <!-- Page Content -->
    <div id="car-view" class="container-fluid">
        <div class="col-md-2">
            <div class="well well-sm">
                <strong>Filter Results</strong>
                <span class="glyphicon glyphicon-filter"></span>
            </div>
            <div class="well well-sm">
                <div class="btn-group">
                    <form id="car-filter-form" method="POST" enctype="multipart/form-data">
                        <label>Type</label><br>
                        <div class="radio">
                            <label><input type="radio" name="hatchback-filter">Hatchback</label>    
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="sedan-filter">Sedan</label>    
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="suv-filter">SUV</label>    
                        </div>
                        <label>Cost</label><br>
                        <div class="radio">
                            <label><input type="radio" name="filter-type">Low to High</label>    
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="filter-type">High to Low</label>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="well well-sm">
                <div class="text-right">
                    <strong>Display</strong>
                    <div class="btn-group">
                        <a href="#" id="list" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-th-list"></span></a>
                        <a href="#" id="grid" class="btn btn-default btn-sm">
                        <span class="glyphicon glyphicon-th"></span></a>
                    </div>
                </div>
            </div>
            
            <div id="products" class="row list-group">
            <?php
                if(isset($_SESSION['admin'])) { if($_SESSION['admin'] == 1) { 
                    include '../php/dbconnect.php';
                    $products_per_page = 3;
                    
                    if(isset($_GET['page'])){
                        $active_page = trim($_GET['page']);
                        $active_page = strip_tags($active_page);
                        $active_page = htmlspecialchars($active_page);
                        $offset = ($active_page-1)*$products_per_page;
                    }else{
                        $offset = 0;
                        $active_page = 1;
                    }

                    $sql1 = "SELECT _id, name, type, capacity, cost_per_hour, image 
                            FROM car, car_details WHERE `car`.`_id` = `car_details`.`car_id` 
                            AND `car`.`deleted` = false";
                    $res1 = mysqli_query($conn, $sql1);
                    $total_rows = mysqli_num_rows($res1);
                    $total_pages = $total_rows / $products_per_page;
                    $total_pages = ceil($total_pages);

                    $sql2 = "SELECT _id, name, type, capacity, cost_per_hour, image 
                            FROM car, car_details WHERE `car`.`_id` = `car_details`.`car_id`
                            AND `car`.`deleted`=false
                            LIMIT $offset, $products_per_page";
                    $res2 = mysqli_query($conn, $sql2);

                    while($row = mysqli_fetch_assoc($res2)) {
                        $car_id = $row['_id'];
                        $carname = $row['name'];
                        $cartype = $row['type'];
                        $carcost = $row['cost_per_hour'];
                        $carcapacity = $row['capacity'];
                        $carimage = $row['image'];
            ?>
                <div class="item  col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <img class="car-img group list-group-image" 
                        src="../../public/images/uploads/<?php echo $carimage; ?>" 
                        alt="<?php echo $carname; ?>" />
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading"><?php echo $carname;?></h4>
                            <p class="group inner list-group-item-text">_id: <?php echo $car_id; ?></p>
                            <p class="group inner list-group-item-text">Type: <?php echo $cartype;?></p>
                            <p class="group inner list-group-item-text">Capacity: <?php echo $carcapacity;?></p>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <p class="lead">$<?php echo $carcost;?></p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <a class="btn btn-success" href="editcarform.php?id=<?php echo $car_id;?>">Update</a>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <a href="carview.php?dl=<?php echo $car_id;?>" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }}}?>
            </div>
            <div class="text-center">
                <ul class="pagination">
                    <?php 
                        for($page_no=1 ; $page_no <= $total_pages ; $page_no++){
                            if($page_no == $active_page) {       
                    ?>
                    <li class="active"><a href="carview.php?page=<?php echo $page_no;?>"><?php echo $page_no;?></a></li>
                        <?php }else{ ?>
                    <li><a href="carview.php?page=<?php echo $page_no;?>"><?php echo $page_no; ?></a></li>
                        <?php } }?>
                </ul>
            </div>
            
        </div>
    </div>
    <!-- Modal -->
    <?php $dl_id; if(isset($_GET['dl'])) {?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#deleteConfirmation").modal("show");
        });
    </script>
    <?php $dl_id = $_GET['dl']; }?>
    <div id="deleteConfirmation" class="modal fade" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you wish to delete this car from the database ?</p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="carview.php">
                <input type="hidden" name="dl-id" value="<?php echo $dl_id;?>">
                <input type="submit" name="delete" class="btn btn-success" value="Yes">
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
      </div>
    </div>
    <?php 
        if(isset($_POST["delete"])){
            $dl_id = $_POST["dl-id"];
            include '../php/dbconnect.php';
            $sql3 = "UPDATE car SET deleted=true WHERE _id='$dl_id'";
            $res3 = mysqli_query($conn, $sql3);
            if($res3){
                header("Location: carview.php");
            }else{
                header("Location: ../../index.php");
            }
        }
    ?>
    <!-- Page Content -->





</div>
    <footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 myCols">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="../../index.php">Home</a></li>
                        <li><a href="register.html">Sign up</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 myCols">
                    <h5>About us</h5>
                    <ul>
                        <li><a href="#">Company Information</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Reviews</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 myCols">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Help desk</a></li>
                        <li><a href="#">Forums</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 myCols">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="social-networks">
            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="facebook"><i class="fa fa-facebook-official"></i></a>
            <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
        </div>
        <div class="footer-copyright">
            <p>© 2016 Copyright Text </p>
        </div>
    </footer>
</body>

</html>
