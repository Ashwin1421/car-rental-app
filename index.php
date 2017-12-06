<!DOCTYPE html>
<html>

<head>
    <title>EZRide</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="shortcut icon" href="public/images/shortcut_icon.png">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Footer-with-social-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/index.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/carousel.css">
    <script type="text/javascript" src="assets/js/carousel.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
<?php
    session_start();
?>
<!-- Background carousel -->
<div class="carousel slide carousel-fade" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
        </div>
        <div class="item">
        </div>
        <div class="item">
        </div>
    </div>
</div>
<!-- Background carousel -->


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
        <a href="index.php" class="navbar-brand">
            EZRide
        </a>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="index.php">Home
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>
        </ul>
        <?php if(isset($_SESSION["admin"])){ if($_SESSION["admin"] == 1){ ?>
        <form method="POST" class="navbar-form navbar-left" action="assets/views/admincarview.php">
            <div class="input-group">
                <input type="text" name="car-name" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button type="submit" name="car-search" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <?php } }?>
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
                            include 'assets/php/dbconnect.php';
                            $sql = "SELECT * 
                                    FROM rent_order 
                                    WHERE status=true 
                                    AND user_id='$user_id'";
                            $res = mysqli_query($conn, $sql);
                            $order_count = mysqli_num_rows($res);
                    ?>
                        
                        <a id="order-list" href="assets/views/orders.php">
                        My Orders&nbsp;<?php if($order_count>0){ echo "<span class='badge badge-dark'>".$order_count."</span>";}?>
                        </a>
                    <?php }?>
                </li>
                <?php if(isset($_SESSION["username"])){ ?>
                <li class="divider"></li>
                <li>
                    <a id="log-out" href="assets/php/logout.php">Logout
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
                        include 'assets/php/dbconnect.php';
                        $user_id = $_SESSION["uid"];
                        $sql3 = "SELECT * FROM rent_order 
                                 WHERE user_id= '$user_id' 
                                 AND status=false
                                 AND car_deleted=false";
                        $res3 = mysqli_query($conn, $sql3);
                        $row3 = mysqli_fetch_assoc($res3);
                        $count = mysqli_num_rows($res3); 
                    ?>
                    <a href="assets/views/cartview.php?id=<?php echo $user_id;?>">
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
                            <a href="assets/views/admincarview.php">
                                Car List
                            </a>
                        </li>
                        <li>
                            <a href="assets/views/addcarform.php">
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
    <div class="container">
        <form id="car-rental-form" class="form-inline" method="POST" action="assets/views/usercarview.php" enctype="multipart/form-data">
            <h3>Rent a car</h3>
            <hr noshade>
            <div class="form-group">
                <select name="pick-up-location" id="pick-up-location" class="form-control empty" required>
                    <option selected="selected" disabled="disabled" style="display:none;">Pick up location</option>
                    <option value="Dallas">Dallas</option>
                    <option value="Irving">Irving</option>
                    <option value="Austin">Austin</option>
                    <option value="Houston">Houston</option>
                </select>
                <input name="pick-up-date" id="pick-up-date" type="text" class="form-control" placeholder="Pick up date" / required>
                <input name="drop-off-date" id="drop-off-date" type="text" class="form-control" placeholder="Drop-off date" required />
                <select name="car-type" id="car-type" class="form-control" required>
                    <option selected="selected" disabled="disabled" style="display:none;">Select Car Type</option>
                    <option value="hatchback">Hatchback</option>
                    <option value="sedan">Sedan</option>
                    <option value="suv">SUV</option>
                  </select>
            </div>
            <div class="form-group">
                <?php if(isset($_SESSION["username"])){ ?>
                <input id="car-search" type="submit" name="search" value="Search" class="btn btn-success">
                <?php 
                        unset($_SESSION["search"]);
                        unset($_SESSION["filter"]);
                    }
                    else{
                ?>
                <a id="car-search" href="assets/views/login.html" class="btn btn-success">Search</a>
                <?php }?>
                <input id="reset" type="reset" name="reset" value="Reset" class="btn btn-danger">
            </div>
        </form>
    </div>

</div>
    <footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 myCols">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="assets/views/register.html">Sign up</a></li>
                        <li><a href="assets/views/login.html">Login</a></li>
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
