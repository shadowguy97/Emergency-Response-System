<?php 
/**
 * User: Pelumi
 * Date: 29/10/18
 * Time: 3:20 PM
 */

//insert function that reloads the page frequently. or find script that reloads the database as it is updated
 session_start();
/*
if(!isset($_SESSION['fullname'])){
    $_SESSION['message'] = "Please Login to access this page.";
    $_SESSION['report'] = '0';
    header('location: login.php');
}*/
include_once "resource/Database.php";

$var = "dash";

$sql = "SELECT * FROM distress_call WHERE dcall_status = 'Unattended' ORDER BY dcall_id ASC";
$statement = $db->prepare($sql);
$statement->execute();
$statement2 = $db->prepare($sql);
$statement2->execute();


$query = 'SELECT COUNT(*) FROM distress_call;';
$sql_query = $db->prepare($query);
$sql_query->execute();
$data = $sql_query->fetchAll();
$len = $data[0]['COUNT(*)'];

$msg = $_SESSION['message'];
$rep = $_SESSION['report'];

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

<script>
function edit(n){
    var len = <?php echo $len; ?>

    for (var i = 0; i <= len; i++){
        if (n == i){
            $('#dcall_status'+i).prop('readonly', false);
            $("#sub"+i).prop('disabled',false);
            $("#sub"+i).removeClass('btn-disabled');
            $("#sub"+i).addClass('btn-success');
            $("#can"+i).prop('disabled',false);
            $("#can"+i).removeClass('btn-disabled');
            $("#can"+i).addClass('btn-danger');
        }
    }
}

function cancel(n){
    var len = <?php echo $len; ?>

    for (var i = 0; i <= len; i++){
        if (n == i){
            $('#dcall_status'+i).prop('readonly', true);
            $("#sub"+i).prop('disabled',true);
            $("#sub"+i).addClass('btn-disabled');
            $("#sub"+i).removeClass('btn-success');
            $("#can"+i).prop('disabled',true);
            $("#can"+i).addClass('btn-disabled');
            $("#can"+i).removeClass('btn-danger');
        }
    }
}

</script>

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
                    <a class="navbar-brand" href="dashboard.php">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#">
                                <i class="fa fa-dashboard"></i>
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
                                <h4 class="title">Distress Calls</h4>
                                <?php
                                if (isset($msg) && $rep == "1"){
                                    echo("
                                        <div class=\"col-md-12 text-center container-fluid\" style= \"background-color: #32CD32; color: black;\">
                                        ".$msg."
                                        </div>"
                                    );
                                }

                                if (isset($msg) && $rep == "0"){
                                    echo("
                                        <div class=\"col-md-12 text-center container-fluid\" style= \"background-color: red; color: black;\">
                                        ".$msg."
                                        </div>"
                                    );
                                }
                            ?>
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
                                                <th>View on Map</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <form method="post" action='formsHandle.php' id="data_form" name="data_form">
                                                <input type="hidden" id="pageID" name="pageID" value="dash">
                                                <input type="hidden" id="category" name="category" value="UPD">
                                                
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
                                                    <td>
                                                        <input class='form-control' id='dcall_status".$var."' name='dcall_status".$var."' value='".$stmt['dcall_status']. "' readonly='readonly'>
                                                        <input type='hidden' id='dcall_id".$var."' name='dcall_id".$var."' value='".$stmt['dcall_id']. "'>
                                                    </td>
                                                    <td><a role='button' data-toggle='modal' data-target='#map_modal".$var."' class='btn btn-success'> <span class='fa fa-map'></span> </a></td>
                                                    <td> <button type='button' class='btn btn-group btn-group-sm btn-primary' onclick='edit(".$var.")'><i class='fa fa-pencil'></i></button>
                                                        <button class='btn btn-group btn-group-sm btn-disabled' type='submit' id='sub".$var."' name='sub".$var."' disabled='disabled'><i class='fa fa-save'></i></button>
                                                        <button class='btn btn-group btn-group-sm btn-disabled' type='button' id='can".$var."' name='can".$var."' disabled='disabled' onclick='cancel(".$var.")'><i class='fa fa-close'></i></button> 
                                                    </td>

                                                    </tr>
                                                    ");
                                                    $var++; 
                                                    } 
                                                ?>
                                            </form>
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

<!-- Modal for Maps -->
<style>
#map {
    width: 500px;
    height: 500px;
}
</style>

<?php
    $var_i = 1;
    while ($stmt_new = $statement2->fetch(PDO::FETCH_ASSOC)){
        echo ("
        <script>

        x = navigator.geolocation;
        x.getCurrentPosition(success, failure);

        function success(position){
            //fetch position coordinates from database
            var mylat = ".$stmt_new['dcall_lat']. ";
            var mylng = ".$stmt_new['dcall_long']. ";

            //Api ready latitude and longitude string
            var coords = new google.maps.LatLng(mylat, mylng);

            //seting up maps
            var mapOptions = {
                zoom: 10,
                center: coords,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            //creates the map
            var map = new.google.maps.Map(document.getElementById('map'), mapOptions);

            //creates a marker
            var marker = new google.mpas.Marker({map: map, position: coords});
        }

        function failure(){
            $('#map".$var_i."').append('Error Loading map')
        }
        </script>
        
        <div class='modal fade' id='map_modal".$var_i."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <h4 class='modal-title text-center' id='myModalLabel'>Distress Location</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='container-fluid'>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div id='map".$var_i."'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ");
        $var_i++;
    }
?>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!-- Data tables -->
<script src="assets/js/datatables.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>

<script>
$(document).ready(function() {
        $('#ems').DataTable();
    });
</script>



<!-- sweet alerts -->
<script src="assets/js/sweetalert.min.js"></script>

<?php
// Success alert script
if (isset($rep) && $rep == "1") {
echo " <script type='text/javascript'>
    try {
            swal('Successfully','".$msg."', 'success');
        } catch () {
            alert('".$msg."');
        }
    </script>";

unset($rep);
unset($msg);
}
// Error alert script
else if (isset($rep) && $rep == "0") {
echo "<script type='text/javascript'>
    try {
            swal('Error', '".$msg."', 'error');
        } catch () {
            alert(alert('".$msg."'););
        }
    </script>";

    unset($rep);
    unset($msg);    
}

unset($rep);
unset($_SESSION['report']);
unset($msg);
unset($_SESSION['message']);

?>
</html>