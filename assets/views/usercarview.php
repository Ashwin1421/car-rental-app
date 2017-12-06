<!DOCTYPE html>
<html>

<head>
    <title>EZRide</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="shortcut icon" href="../../public/images/shortcut_icon.png">
    <link rel="stylesheet" href="../css/Footer-with-social-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
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
        <form method="POST" class="navbar-form navbar-left" action="usercarview.php">
            <div class="input-group">
                <input type="text" name="car-name" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button type="submit" name="car-search" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
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
                    <?php 
                        if(isset($_SESSION["username"])){ 
                            $user_id = $_SESSION['uid'];
                            include '../php/dbconnect.php';
                            $sql = "SELECT * 
                                    FROM rent_order 
                                    WHERE status=true 
                                    AND user_id='$user_id'";
                            $res = mysqli_query($conn, $sql);
                            $order_count = mysqli_num_rows($res);
                    ?>
                        
                        <a id="order-list" href="orders.php">
                        My Orders&nbsp;<?php if($order_count>0){ echo "<span class='badge badge-dark'>".$order_count."</span>";}?>
                        </a>
                    <?php }?>
                </li>
                <?php if(isset($_SESSION["username"])){ ?>
                <li class="divider"></li>
                <li>
                    <a id="log-out" href="../php/logout.php">Logout
                    <span class="glyphicon glyphicon-log-out"></span>
                    </a>
                </li>
                <?php }?>
            </ul>
            </li>
        </ul>
        <!-- Order cart controller -->
        <?php if(isset($_SESSION["username"])){ ?>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php 
                        include '../php/dbconnect.php';
                        $user_id = $_SESSION["uid"];
                        $sql3 = "SELECT * FROM rent_order 
                                 WHERE user_id= '$user_id' 
                                 AND status=false 
                                 AND car_deleted=false";
                        $res3 = mysqli_query($conn, $sql3);
                        $row3 = mysqli_fetch_assoc($res3);
                        $count = mysqli_num_rows($res3); 
                    ?>
                    <a href="cartview.php?id=<?php echo $user_id;?>">
                    My Cart&nbsp;<span class="glyphicon glyphicon glyphicon-shopping-cart"></span>
                    <?php if($count>0){ echo $count;}?>
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
                            <a href="admincarview.php">
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
                <strong>Filter Cars</strong>
                <span class="glyphicon glyphicon-filter"></span>
            </div>
            <div class="well well-sm">
                <div class="btn-group">
                    <form id="car-filter-form" method="POST" enctype="multipart/form-data" action="usercarview.php">
                        <label>Cost</label>
                        <div class="radio">
                            <label><input id="lh-filter" type="radio" name="filter" value="low-high">Low to High</label>    
                        </div>
                        <div class="radio">
                            <label><input id="hl-filter" type="radio" name="filter" value="high-low">High to Low</label>    
                        </div>
                        <input id="apply-filter" type="submit" name="apply-filter" value="Apply" class="btn btn-primary">
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
            <!-- user car view -->
            <?php
                if(
                    (isset($_POST["search"]) && 
                    (!isset($_POST['apply-filter'])) && 
                    (!isset($_SESSION['filter']))) ||
                    isset($_SESSION['search'])
                    ) 
                { 
                    
                    if(isset($_POST['search'])){
                        $car_location = $_POST["pick-up-location"];
                        $pick_up_date = $_POST["pick-up-date"];
                        $drop_off_date = $_POST["drop-off-date"];
                        $car_type = $_POST["car-type"];
                        //storing for later results
                        unset($_SESSION['filter']);
                        $_SESSION["search"] = "search";
                        $_SESSION["car_location"] = $car_location;
                        $_SESSION["pick_up_date"] = $pick_up_date;
                        $_SESSION["drop_off_date"] = $drop_off_date;
                        $_SESSION["car_type"] = $car_type;
                    }else{
                        unset($_SESSION['filter']);
                        $car_location = $_SESSION["car_location"];
                        $pick_up_date = $_SESSION["pick_up_date"];
                        $drop_off_date = $_SESSION["drop_off_date"];
                        $car_type = $_SESSION["car_type"];
                    }
                                        
                    
                    $user_id = $_SESSION["uid"];

                    $d1= new DateTime($pick_up_date);
                    $d2= new DateTime($drop_off_date);

                    $period = $d2->diff($d1)->days;

                    $cars_per_page = 3;
                    if(isset($_GET['page'])){
                        $active_page = trim($_GET['page']);
                        $active_page = strip_tags($active_page);
                        $active_page = htmlspecialchars($active_page);
                        $offset = ($active_page-1)*$cars_per_page;
                    }else{
                        $offset = 0;
                        $active_page = 1;
                    }
                    include '../php/dbconnect.php';

                    if(isset($_POST['car-search'])){
                        $car_search_name = $_POST['car-name'];
                        $_SESSION['car-name'] = $car_search_name;
                    }else{
                        $car_search_name = $_SESSION['car-name'];
                    }

                    if(isset($car_search_name)){
                        $sql1 = "SELECT _id, name, type, location, capacity, image, price_per_day
                                 FROM car, car_capacity
                                 WHERE `car`.`type` = `car_capacity`.`car_type` 
                                 AND `car`.`deleted`=false 
                                 AND `car`.`status`=false
                                 AND `car`.`type` = '$car_type'
                                 AND `car`.`location` = '$car_location'
                                 AND `car`.`name` LIKE '%$car_search_name%'
                                 LIMIT $offset, $cars_per_page";
                        $res1 = mysqli_query($conn, $sql1);

                        $sql2 = "SELECT * 
                                 FROM car, car_capacity
                                 WHERE `car`.`type` = `car_capacity`.`car_type` 
                                 AND `car`.`deleted`=false 
                                 AND `car`.`status`=false
                                 AND `car`.`type` = '$car_type'
                                 AND `car`.`location` = '$car_location' 
                                 AND `car`.`name` LIKE '%$car_search_name%'";
                        $res2 = mysqli_query($conn, $sql2);

                        $total_rows = mysqli_num_rows($res2);
                        $total_pages = $total_rows / $cars_per_page;

                    }
                    else{
                        $sql1 = "SELECT _id, name, type, location, capacity, image, price_per_day
                                FROM car, car_capacity
                                WHERE `car`.`type` = `car_capacity`.`car_type` 
                                AND `car`.`deleted`=false 
                                AND `car`.`status`=false
                                AND `car`.`type` = '$car_type'
                                AND `car`.`location` = '$car_location'
                                LIMIT $offset, $cars_per_page";
                        $res1 = mysqli_query($conn, $sql1);

                        $sql2 = "SELECT * 
                                 FROM car, car_capacity
                                 WHERE `car`.`type` = `car_capacity`.`car_type` 
                                 AND `car`.`deleted`=false 
                                 AND `car`.`status`=false
                                 AND `car`.`type` = '$car_type'
                                 AND `car`.`location` = '$car_location'";
                        $res2 = mysqli_query($conn, $sql2);

                        $total_rows = mysqli_num_rows($res2);
                        $total_pages = $total_rows / $cars_per_page;

                    }

                    while($row = mysqli_fetch_assoc($res1)){
                        $car_id = $row["_id"];
                        $car_name = $row["name"];
                        $car_type = $row["type"];
                        $car_capacity = $row["capacity"];
                        $car_cost = $row["price_per_day"];
                        $car_location = $row["location"];
                        $car_image = $row["image"];

                        $order_date = new DateTime();
                        $order_date = $order_date->format("m/d/Y");
            ?>

                <div class="item  col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <img class="car-img group list-group-image" 
                        src="../../public/images/uploads/<?php echo $car_image; ?>" 
                        alt="<?php echo $car_name; ?>" />
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading"><?php echo $car_name;?></h4>
                            <p class="group inner list-group-item-text">Type: <?php echo $car_type;?></p>
                            <p class="group inner list-group-item-text">Location: <?php echo $car_location;?></p>
                            <p class="group inner list-group-item-text">Capacity: <?php echo $car_capacity;?></p>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="lead">$<?php echo $car_cost;?></p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <?php $_SESSION["booking_count"]=1; ?>
                                    <form method="POST" action="../php/neworder.php" enctype="multipart/formdata">
                                        <input type="text" name="pick-up-date" value="<?php echo $pick_up_date;?>" hidden>
                                        <input type="text" name="drop-off-date" value="<?php echo $drop_off_date;?>" hidden>
                                        <input type="number" step="0.01" name="rent-amount" 
                                        value="<?php echo $period*$car_cost;?>" hidden>
                                        <input type="text" name="car-id" value="<?php echo $car_id;?>" hidden>
                                        <input type="text" name="user-id" value="<?php echo $user_id;?>" hidden>
                                        <input type="submit" name="book-now" value="Book Now" class="btn btn-success">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } } ?>
            <!-- user car view -->
            <!-- filtered car view -->
            <?php
                if(isset($_POST["apply-filter"]) || isset($_SESSION['filter'])) { 

                    $car_location = $_SESSION["car_location"];
                    $pick_up_date = $_SESSION["pick_up_date"];
                    $drop_off_date = $_SESSION["drop_off_date"];
                    $period = $_SESSION["period"];
                    $car_type = $_SESSION["car_type"];

                    if(isset($_POST['filter'])){
                        $filter = $_POST["filter"];
                        $_SESSION['filter'] = $filter;
                        unset($_SESSION['search']);
                    }else{
                        $filter = $_SESSION['filter'];
                        unset($_SESSION['search']);
                    }
                    
                    if($filter == "low-high"){
                        $order_by = "ASC";
                    }else{
                        $order_by = "DESC";
                    }
                    $cars_per_page = 3;
                    if(isset($_GET['page'])){
                        $active_page = trim($_GET['page']);
                        $active_page = strip_tags($active_page);
                        $active_page = htmlspecialchars($active_page);
                        $offset = ($active_page-1)*$cars_per_page;
                    }else{
                        $offset = 0;
                        $active_page = 1;
                    }
                    include '../php/dbconnect.php';
                    $sql1 = "SELECT _id, name, type, location, capacity, image, price_per_day
                            FROM car, car_capacity
                            WHERE `car`.`type` = `car_capacity`.`car_type` 
                            AND `car`.`deleted`=false 
                            AND `car`.`status`=false
                            AND `car`.`type` = '$car_type'
                            AND `car`.`location` = '$car_location'
                            ORDER BY price_per_day $order_by
                            LIMIT $offset, $cars_per_page ";
                    $res1 = mysqli_query($conn, $sql1);

                    $sql2 = "SELECT * 
                             FROM car, car_capacity
                             WHERE `car`.`type` = `car_capacity`.`car_type` 
                             AND `car`.`deleted`=false 
                             AND `car`.`status`=false
                             AND `car`.`type` = '$car_type'
                             AND `car`.`location` = '$car_location'";
                    $res2 = mysqli_query($conn, $sql2);

                    $total_rows = mysqli_num_rows($res2);
                    $total_pages = $total_rows / $cars_per_page;

                    while($row = mysqli_fetch_assoc($res1)){
                        $car_id = $row["_id"];
                        $car_name = $row["name"];
                        $car_type = $row["type"];
                        $car_capacity = $row["capacity"];
                        $car_cost = $row["price_per_day"];
                        $car_location = $row["location"];
                        $car_image = $row["image"];

                        $order_date = new DateTime();
                        $order_date = $order_date->format("m/d/Y");

                        $user_id = $_SESSION["uid"];
            ?>

                <div class="item  col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <img class="car-img group list-group-image" 
                        src="../../public/images/uploads/<?php echo $car_image; ?>" 
                        alt="<?php echo $car_name; ?>" />
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading"><?php echo $car_name;?></h4>
                            <p class="group inner list-group-item-text">Type: <?php echo $car_type;?></p>
                            <p class="group inner list-group-item-text">Location: <?php echo $car_location;?></p>
                            <p class="group inner list-group-item-text">Capacity: <?php echo $car_capacity;?></p>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="lead">$<?php echo $car_cost;?></p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <?php $_SESSION["booking_count"]=1; ?>
                                    <form method="POST" action="../php/neworder.php" enctype="multipart/formdata">
                                        <input type="text" name="pick-up-date" value="<?php echo $pick_up_date;?>" hidden>
                                        <input type="text" name="drop-off-date" value="<?php echo $drop_off_date;?>" hidden>
                                        <input type="number" step="0.01" name="rent-amount" 
                                        value="<?php echo $period*$car_cost;?>" hidden>
                                        <input type="text" name="car-id" value="<?php echo $car_id;?>" hidden>
                                        <input type="text" name="user-id" value="<?php echo $user_id;?>" hidden>
                                        <input type="submit" name="book-now" value="Book Now" class="btn btn-success">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } } ?>
            <!-- filtered car view -->

            
            </div>

            <div class="text-center">
                <ul class="pagination">
                    <?php 
                        for($page_no=1 ; $page_no <= $total_pages ; $page_no++){
                            if($page_no == $active_page) {       
                    ?>
                    <li class="active"><a href="usercarview.php?page=<?php echo $page_no;?>"><?php echo $page_no;?></a></li>
                        <?php }else{ ?>
                    <li><a href="usercarview.php?page=<?php echo $page_no;?>"><?php echo $page_no; ?></a></li>
                        <?php } }?>
                </ul>
            </div>
            
        </div>
    </div>
</div>




<footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 myCols">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="../../index.php">Home</a></li>
                        <li><a href="register.html">Sign up</a></li>
                        <li><a href="login.html">Login</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 myCols">
                    <h5>Contact Us</h5>
                    <ul>
                        <li>
                            <a href="mailto: avj160330@utdallas.edu">
                            <i class="fa fa-envelope"></i> 
                            Ashwin Joshi
                            </a>
                        </li>
                        <li>
                            <a href="mailto: yas160130@utdallas.edu">
                            <i class="fa fa-envelope"></i> 
                            Yash Sanzgiri
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4 myCols">
                    <h5>About us</h5>
                    <ul>
                        <li>
                            <a href="https://github.com/Ashwin1421">
                            <i class="fa fa-github"></i> 
                            Ashwin Joshi
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/yashsanzgiri">
                            <i class="fa fa-github"></i> 
                            Yash Sanzgiri
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>
            Developed by, 
            <a href="https://github.com/Ashwin1421">Ashwin J.</a>&nbsp;&amp;
            <a href="https://github.com/yashsanzgiri">Yash S.</a>
            </p>
        </div>
    </footer>
</body>

</html>
