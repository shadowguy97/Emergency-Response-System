<?php
session_start();

?>

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

<body style="background:url('assets/img/pic6.jpg'); background-repeat: no-repeat; background-size: cover;">
<!-- Insert script to get longitude and latitude -->
<script>

</script>
<div class="row">
    <div class="col-md-12">
        <div class="text-center">
            <h1 class="hero-title">Distress Call</h1>
            <p class="hero-subtitle">Please click the button that fits your situations.</p>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <!-- Button to open modal function and let form be submitted from modal -->
                <a class="btn btn-danger action-button" role="button" data-toggle="modal" data-target="#fire_help">
                <img src="assets/img/pic5.jpg" class="img-responsive" alt="fire_dept">
                    FIRE
                </a>
            </div>
            <br><br>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <!-- Button to open modal function and let form be submitted from modal -->
                <a class="btn btn-danger action-button" role="button" data-toggle="modal" data-target="#health_help">
                <img src="assets/img/pic1.jpg" class="img-responsive" alt="health_dept">
                    HEALTH
                </a>
            </div>
            <br><br>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <!-- Button to open modal function and let form be submitted from modal -->
                <a class="btn btn-danger action-button" role="button" data-toggle="modal" data-target="#sec_help">
                    <img src="assets/img/opt.jpeg" class="img-responsive" alt="security_dept"> <!-- change the image to a security pic -->
                    SECURITY
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modals for submitting signals -->

<!-- Modals for Fire signals -->
<div class="modal fade" id="fire_help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Please Input Your Phone Number.</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="formsHandle.php" name="distressForm" id="distressForm">
                                <input type="hidden" id="category" name="category" value="fireForm">
                                <input type="hidden" id="pageID" name="pageID" value="distress">
                                <input type="hidden" id="type" name="type" value="Fire">
                                <div class="form-group">
                                    <label for="phone">Longitude :</label>
                                    <input type="text" class="form-control" id="lng" name="lng" placeholder="Longitude" readonly="readonly" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Latitude :</label>
                                    <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitude" readonly="readonly" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number :</label>
                                    <input type="text" class="form-control" id="tel" name="tel" placeholder="Phone Number" required>
                                </div>
                                <div class="form-group">
                                    <button id="get_loc" name="get_loc" class="btn btn-primary btn-block">Get My Location</button>
                                    <button type="submit" id="sub" name="sub" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals for Health signals -->
<div class="modal fade" id="health_help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Please Input Your Phone Number.</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="formsHandle.php" name="distressForm" id="distressForm">
                                <input type="hidden" id="category" name="category" value="healthForm">
                                <input type="hidden" id="pageID" name="pageID" value="distress">
                                <input type="hidden" id="type" name="type" value="Health">
                                <div class="form-group">
                                    <label for="phone">Longitude :</label>
                                    <input type="text" class="form-control" id="lng" name="lng" placeholder="Longitude" readonly="readonly" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Latitude :</label>
                                    <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitude" readonly="readonly" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number :</label>
                                    <input type="text" class="form-control" id="tel" name="tel" placeholder="Phone Number" required>
                                </div>
                                <div class="form-group">
                                    <button id="get_loc" name="get_loc" class="btn btn-primary btn-block">Get My Location</button>
                                    <button type="submit" id="sub" name="sub" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals for Security signals -->
<div class="modal fade" id="sec_help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Please Input Your Phone Number.</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="formsHandle.php" name="distressForm" id="distressForm">
                                <input type="hidden" id="category" name="category" value="securityForm">
                                <input type="hidden" id="pageID" name="pageID" value="distress">
                                <input type="hidden" id="type" name="type" value="Security">
                                <div class="form-group">
                                    <label for="phone">Longitude :</label>
                                    <input type="text" class="form-control" id="lng" name="lng" placeholder="Longitude" readonly="readonly" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Latitude :</label>
                                    <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitude" readonly="readonly" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number :</label>
                                    <input type="text" class="form-control" id="tel" name="tel" placeholder="Phone Number" required>
                                </div>
                                <div class="form-group">
                                    <button id="get_loc" name="get_loc" class="btn btn-primary btn-block">Get My Location</button>
                                    <button type="submit" id="sub" name="sub" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.12.4.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

</html>
