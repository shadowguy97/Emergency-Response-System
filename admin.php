<?php 
/**
 * User: Pelumi
 * Date: 21/11/18
 * Time: 12:30 PM
 */

session_start();
include_once "resource/Database.php";

$var = "admin";
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

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/fonts/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="assets/fonts/font-awesome.min.css" rel="stylesheet" />

    <!-- sweet alerts -->
    <script src="assets/js/sweetalert.min.js"></script>

</head>
<body>
<div class="wrapper">
    <!-- sidebar start -->
    <?php include 'sidebar.php';?>
    <!-- sidebar end -->

    <!-- main panel starts -->
    <div class="main-panel">
        <!-- navbar start -->
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="admin.php">Administrator</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i>
                            </a>
                        </li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <button class="btn btn-disabled">
                                Hello <?php print_r ($_SESSION['fullname']); ?>
                            </button>
                        </li>

                        <li>
                            <a href="logout.php" class="btn btn-danger">
                                <img src="assets/img/logout.png" alt="logout" style="height: 30px; width: 30px">
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- navbar end -->

        <!-- contents and every other thing goes here -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="content">
                                <div class="thumbnail">
                                    <img style="height: 300px; width: 300px;" src="assets/img/admin.jpeg" alt="admin"><br>
                                    <p class="text-center" style="color: black"> <a href="reg_admin.php" class="btn btn-primary btn-block"> Add New Administrators </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="content">
                                <div class="thumbnail">
                                    <img style="height: 300px; width: 100%;" src="assets/img/opt.jpeg" alt="operators"><br>
                                    <p class="text-center" style="color: black"> <a href="reg_operator.php" class="btn btn-primary btn-block"> Add New Emergency Operators </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div> <!-- main panel ends -->

</div>



</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- sweet alerts -->
<script src="assets/js/sweetalert.min.js"></script>

<script type="text/javascript">
$("button").click(function(){
        $("#sub").hide();
        $("#load").show();
    });

    $(window).on('load', function(){
        $("#sub").show();
        $("#load").hide();
    });
</script>

<?php
// Add alert script
if (isset($suc) && $suc != "") {
    echo " <script type='text/javascript'>
        try {
            swal('Successfully Created','Game has been created.', 'success');
        } catch (err) {
            alert('Game has been created.');
        }
    </script>";

unset($suc);
}

else if (isset($err) && $err != "" ){
echo "<script type='text/javascript'>
    try {
            swal('Error In creating the Game', '<?php echo $err; ?>', 'error');
        } catch (err) {
            alert('Error in creating the Game ' + '(<?php echo $err; ?>)');
        }
    </script>";

}
unset($err);


// Update alert script

if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    if(isset($_SESSION['report']) && $_SESSION['report'] == "1"){
        echo "<script type='text/javascript'>
                try {
                    swal('Successfully Added','Admin has been added successfully.', 'success');
                } catch (err) {
                    alert('Admin has been added successfully.');
                }
            </script>";
    }
unset($_SESSION['message']);
unset($_SESSION['report']);
}

elseif (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    if(isset($_SESSION['report']) && $_SESSION['report'] == "0"){
        echo "<script type='text/javascript'>
                try {
                    swal('Error','Error adding Admin.', 'error');
                } catch (err) {
                    alert('Error adding Admin.');
                }
            </script>";
    }

unset($_SESSION['message']);
unset($_SESSION['report']);
}
?>

</html>