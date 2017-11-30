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
            <h4>Filters</h4>
        </div>
        <div class="col-md-10">
            <div id="car-list" class="list-group clearfix">
            </div>
        </div>
    </div>
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
