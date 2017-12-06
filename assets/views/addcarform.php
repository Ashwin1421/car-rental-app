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
    <link rel="stylesheet" type="text/css" href="../css/form.css">
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
        <?php if(isset($_SESSION["admin"])){ if($_SESSION["admin"] == 1){ ?>
        <form method="POST" class="navbar-form navbar-left" action="admincarview.php">
        <?php }}else{ ?>
        <form method="POST" class="navbar-form navbar-left" action="usercarview.php">
        <?php } ?>
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
    <div class="container">
        <form id="car-add-form" class="form-horizontal" action="../php/addcar.php" method="POST" 
        enctype="multipart/form-data">
            <h4>Add a new car</h4>
            <hr>
            <div class="form-group">
                <label for="car-name" class="control-label col-sm-2">Car Name:</label>
                <div class="col-sm-4">
                    <input type="text" name="car-name" id="car-name" required="" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="car-type" class="control-label col-sm-2">Car Type:</label>
                <div class="col-sm-4">
                <select name="car-type" id="car-type" class="form-control">
                    <option selected="selected" disabled="disabled" style="display:none;">Select Car Type</option>
                    <option value="hatchback">Hatchback</option>
                    <option value="sedan">Sedan</option>
                    <option value="suv">SUV</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label for="car-location" class="control-label col-sm-2">Car Location:</label>
                <div class="col-sm-4">
                <select name="car-location" id="car-location" class="form-control">
                    <option selected="selected" disabled="disabled" style="display:none;">Select Car Location</option>
                    <option value="Dallas">Dallas</option>
                    <option value="Irving">Irving</option>
                    <option value="Austin">Austin</option>
                    <option value="Houston">Houston</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label for="car-cost" class="control-label col-sm-2">Cost:</label>
                <div class="col-sm-2">
                    <input type="number" step="0.01" name="car-cost" id="car-cost" class="form-control" min="4.99" max="99.99" placeholder="&dollar; / day">
                </div>
            </div>
            <div class="form-group">
                <label for="car-image" class="control-label col-sm-2">Car Image:</label>
                <div class="col-sm-2">
                    <input type="file" name="car-image" id="car-image" class="file" data-show-preview="false">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" name="add-car" value="Add Car" class="btn btn-success">
                  <input type="reset" name="reset" value="Reset" class="btn btn-danger">
                </div>
            </div>
        </form>
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
