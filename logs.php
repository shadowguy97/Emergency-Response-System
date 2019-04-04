<?php
/**
 * User: Pelumi
 * Date: 29/10/18
 * Time: 3:20 PM
 */

 session_start(); 
 include_once "resource/Database.php";
 $eType = $_SESSION['eType'];

if(!isset($_SESSION['fullname'])){
    $_SESSION['message'] = "Please Login to access this page.";
    $_SESSION['report'] = '0';
    header('location: login.php');
}

$var = "logs";

if(isset($eType)){
    switch ($eType) {
        case "General":
            $sql = "SELECT * FROM distress_call ORDER BY dcall_id ASC";
            $statement = $db->prepare($sql);
            $statement->execute();
        break;

        case "Fire":
            $sql = "SELECT * FROM distress_call WHERE dcall_type = 'Fire' ORDER BY dcall_id ASC";
            $statement = $db->prepare($sql);
            $statement->execute();
        break;

        case "Security":
            $sql = "SELECT * FROM distress_call WHERE dcall_type = 'Security' ORDER BY dcall_id ASC";
            $statement = $db->prepare($sql);
            $statement->execute();
        break;

        case "Health":
            $sql = "SELECT * FROM distress_call WHERE dcall_type = 'Health' ORDER BY dcall_id ASC";
            $statement = $db->prepare($sql);
            $statement->execute();
        break;

    }
}

else{
    $sql = "SELECT * FROM distress_call ORDER BY dcall_id ASC";
    $statement = $db->prepare($sql);
    $statement->execute();
}

?>

<!DOCTYPE html>
<html>

<head>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>EMS: Emergency Medical System </title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />


    <!-- Data Table -->
    <link rel="stylesheet" href="assets/css/datatables.css">

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/fonts/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="assets/fonts/font-awesome.min.css" rel="stylesheet" />

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
                    <a class="navbar-brand" href="logs.php">Emergency logs</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#">
                                <i class="fa fa-sticky-note"></i>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Emergency Logs</h4>
                            </div>

                            <div class="content">
                                <div class="table-responsive">
                                        <table class="table table-hover" id="ems">
                                        <thead>
                                            <tr class="info">
                                                <th>#</th>
                                                <th>Emergency type</th>
                                                <th>Longitude</th>
                                                <th>Latitude</th>
                                                <th>Date & Time</th>
                                                <th>Phone Number</th>
                                                <th>Responded</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                            <?php
                                            $var = 1;
                                            while ($stmt = $statement->fetch(PDO::FETCH_ASSOC)){
                                                echo ("
                                                    <tr id='row".$var."' name='row".$var."'>
                                                    <td> ".$var." </td>
                                                    <td> ".$stmt['dcall_type']. " </td>
                                                    <td> ".$stmt['dcall_long']. " </td>
                                                    <td> ".$stmt['dcall_lat']. " </td>
                                                    <td> ".$stmt['dcall_time']. " </td>
                                                    <td> ".$stmt['dcall_phone']. " </td>
                                                    <td> ".$stmt['dcall_status']. " </td>
                                                    </tr>"
                                                );
                                                $var++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                </div>
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

<!-- Data tables -->
<script src="assets/js/datatables.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- sweet alerts -->
<script src="assets/js/sweetalert.min.js"></script>


<script>
$(document).ready(function() {
        $('#ems').DataTable();
    });
</script>
</html>