<!DOCTYPE html>
<html>

<head>
    <title>Footer with social icons</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Footer-with-social-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
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
        <a href="#" class="navbar-brand">Brand</a>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Profile</a></li>
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
                <span class="glyphicon glyphicon-user"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="assets/views/register.html">Sign-Up</li>
                <li><a href="assets/views/login.html">Login</a></li>
                <li><a href="">Logout</a></li>
            </ul>
            </li>
        </ul>
    </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <form id="car-rental-form" class="form-horizontal">
  <div class="form-group">
    <label for="pick-up-location" class="control-label col-sm-2">Pick-Up Location:</label>
    <div class="col-sm-2">
      <select id="pick-up-location" class="form-control empty">
        <option selected="selected" disabled="disabled" style="display:none;">Select Location</option>
        <option>Dallas</option>
        <option>Irving</option>
        <option>Austin</option>
        <option>Houston</option>
      </select>
    </div>
    <div class="form-group">
      <label for="pick-up-date" class="control-label col-sm-2">Pick-Up Date:</label>
      <div class="col-sm-2">
        <input id="pick-up-date" type="date" class="form-control"/>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="drop-off-location" class="control-label col-sm-2">Drop-Off Location:</label>
    <div class="col-sm-2">
      <select id="drop-off-location" class="form-control">
        <option selected="selected" disabled="disabled" style="display:none;">Select Location</option>
        <option>Dallas</option>
        <option>Irving</option>
        <option>Austin</option>
        <option>Houston</option>
      </select>
    </div>
    <div class="form-group">
      <label for="drop-off-date" class="control-label col-sm-2">Drop-Off Date:</label>
      <div class="col-sm-2">
        <input id="drop-off-date" type="date" class="form-control"/>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="car-type" class="control-label col-sm-2">Car Type:</label>
    <div class="col-sm-2">
      <select id="car-type" class="form-control">
        <option selected="selected" disabled="disabled" style="display:none;">Select Car Type</option>
        <option>Hatchback</option>
        <option>Sedan</option>
        <option>SUV</option>
        <option>Semi</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
    </div>






</div>
    <footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 myCols">
                    <h5>Get started</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Sign up</a></li>
                        <li><a href="#">Downloads</a></li>
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
