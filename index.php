<!doctype html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>EMS: Emergency Medical System </title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

  <!-- Bootstrap core CSS     -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/Pretty-Header.css">
  <link rel="stylesheet" href="assets/css/Hero-Technology.css">
    

  <!--     Fonts and icons     -->
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
</head>

<body style="background:url('assets/img/pic6.jpg')">
<div class="row">
    <div class="col-md-12">
        <nav class="navbar navbar-default custom-header">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand navbar-link" href="#">Emergency Response System</a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right links">
                        <li role="presentation"><a href="index.php">Home </a></li>
                        <li role="presentation"><a href="login.php">Login </a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="col-md-12">
        <div class="text-center">
            <h1 class="hero-title">Distress Call</h1>
            <p class="hero-subtitle">Please click the button that fits your situations.</p>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <!-- Insert script to get longitude and latitude -->
                <form method="post" action="formsHandle.php" name="distressForm" id="distressForm">
                    <input type="hidden" id="category" name="category" value="fireForm">
                    <input type="hidden" id="pageID" name="pageID" value="distress">
                    <input type="hidden" id="longitude" name="longitude" value="">
                    <input type="hidden" id="latitude" name="latitude" value="">
                    <button type="submit" id="sub" name="sub" class="btn btn-danger btn-block">
                        <img src="assets/img/pic5.jpg" class="img-responsive" alt="fire_dept">
                        FIRE
                    </button>
                </form>
            </div>
            <br><br>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <!-- Insert script to get longitude and latitude -->
                <form method="post" action="formsHandle.php" name="distressForm" id="distressForm">
                    <input type="hidden" id="category" name="category" value="fireForm">
                    <input type="hidden" id="pageID" name="pageID" value="distress">
                    <input type="hidden" id="longitude" name="longitude" value="">
                    <input type="hidden" id="latitude" name="latitude" value="">
                    <button type="submit" id="sub" name="sub" class="btn btn-danger btn-block">
                        <img src="assets/img/pic1.jpg" class="img-responsive" alt="health_dept">
                        HEALTH
                    </button>
                </form>
            </div>
            <br><br>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <!-- Insert script to get longitude and latitude -->
                <form method="post" action="formsHandle.php" name="distressForm" id="distressForm">
                    <input type="hidden" id="category" name="category" value="fireForm">
                    <input type="hidden" id="pageID" name="pageID" value="distress">
                    <input type="hidden" id="longitude" name="longitude" value="">
                    <input type="hidden" id="latitude" name="latitude" value="">
                    <button type="submit" id="sub" name="sub" class="btn btn-danger btn-block">
                        <img src="assets/img/opt.jpeg" class="img-responsive" alt="security_dept">
                         SECURITY
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.12.4.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

</html>
