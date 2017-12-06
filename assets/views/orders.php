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
                            <a href="carview.php">
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
    <div id="order-view" class="container-fluid">
        <div class="well well-sm">
            <strong>My Orders</strong>
        </div>
        <!-- List of orders -->
        <div id="products" class="row list-group">
            <?php 
                include '../php/dbconnect.php';
                $sql4 = "SELECT * 
                         FROM rent_order 
                         WHERE status=true 
                         AND user_id = '$user_id'";
                $res4 = mysqli_query($conn, $sql4);
                $order_count = mysqli_num_rows($res4);
                if($order_count == 0){
                    echo "<h4 class='text-center'>You have no orders yet. Please check your cart for any unchecked items.</h4><br>";
                }else{
                    $sql5 = "SELECT _id, name, type, capacity, pickup_date, dropoff_date, location, image, order_date, rent_amount, order_id 
                             FROM car, car_capacity, rent_order 
                             WHERE `rent_order`.`user_id`= '$user_id' 
                             AND `rent_order`.`car_id` = `car`.`_id` 
                             AND `car`.`type`=`car_capacity`.`car_type` 
                             AND `rent_order`.`status`=true";
                    $res5 = mysqli_query($conn, $sql5);
                    while($row5 = mysqli_fetch_assoc($res5)){
                        $car_name = $row5['name'];
                        $car_id = $row5['_id'];
                        $car_image = $row5['image'];
                        $car_type = $row5['type'];
                        $car_location = $row5['location'];
                        $car_capacity = $row5['capacity'];
                        $order_date = $row5['order_date'];
                        $pickup_date = $row5['pickup_date'];
                        $dropoff_date = $row5['dropoff_date'];
                        $total_rent_amt = $row5['rent_amount'];
                        $order_id = $row5['order_id'];
            ?>
                <div class="item  col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <img class="car-img group list-group-image" 
                        src="../../public/images/uploads/<?php echo $car_image; ?>" 
                        alt="<?php echo $car_name; ?>" />
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading"><?php echo $car_name;?></h4>
                            <p class="group inner list-group-item-text">Type: <?php echo $car_type;?></p>
                            <p class="group inner list-group-item-text">Pick-Up Location: <?php echo $car_location;?></p>
                            <p class="group inner list-group-item-text">Capacity: <?php echo $car_capacity;?></p>
                            <p class="group inner list-group-item-text">Order Date: <?php echo $order_date;?></p>
                            <p class="group inner list-group-item-text">Pick-Up Date: <?php echo $pickup_date;?></p>
                            <p class="group inner list-group-item-text">Drop-Off Date: <?php echo $dropoff_date;?></p>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="lead">Total: $<?php echo $total_rent_amt;?></p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <form method="POST" action="../php/deleteorder.php" enctype="multipart/formdata">
                                        <input type="submit" name="delete-order-from-orders" value="Cancel Order" class="btn btn-danger">
                                        <input type="text" name="order-id" value="<?php echo $order_id;?>" hidden>
                                        <input type="text" name="car-id" value="<?php echo $car_id;?>" hidden>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }}?>
        </div>
        <!-- List of orders -->
    </div>
    
    <!-- Page Content -->





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
