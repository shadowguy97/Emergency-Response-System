<?php
/**
 * User: Pelumi
 * Date: 29/10/18
 * Time: 3:20 PM
 */

 session_start(); 
 /*
if(!isset($_SESSION['fullname'])){
    $_SESSION['message'] = "Please Login to access this page.";
    $_SESSION['report'] = '0';
    header('location: login.php');
}*/
 include_once "resource/Database.php";

$var = "agents";

$msg = $_SESSION['message'];
$rep = $_SESSION['report'];

$sql = "SELECT * FROM service_provider ORDER BY sp_id ASC";
$statement = $db->prepare($sql);
$statement->execute();

$query = 'SELECT COUNT(*) FROM service_provider;';
$sql_query = $db->prepare($query);
$sql_query->execute();
$data = $sql_query->fetchAll();
$len = $data[0]['COUNT(*)'];

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

<script>
function edit(n){
    var len = <?php echo $len; ?>

    for (var i = 0; i <= len; i++){
        if (n == i){
            $('#sp_id'+i).prop('readonly', false);
            $('#sp_class'+i).prop('readonly', false);
            $('#sp_phone'+i).prop('readonly', false);
            $('#sp_name'+i).prop('readonly', false);
            $("#sub"+i).prop('disabled',false);
            $("#sub"+i).removeClass('btn-disabled');
            $("#sub"+i).addClass('btn-success');
            $("#can"+i).prop('disabled',false);
            $("#can"+i).removeClass('btn-disabled');
            $("#can"+i).addClass('btn-danger');
            $("#del"+i).prop('disabled',true);
            $("#del"+i).addClass('btn-disabled');
            $("#del"+i).removeClass('btn-danger');
        }
    }
}

function cancel(n){
    var len = <?php echo $len; ?>

    for (var i = 0; i <= len; i++){
        if (n == i){
            $('#sp_name'+i).prop('readonly', true);
            $('#sp_class'+i).prop('readonly', true);
            $('#sp_phone'+i).prop('readonly', true);
            $('#sp_id'+i).prop('readonly', true);
            $("#sub"+i).prop('disabled',true);
            $("#sub"+i).addClass('btn-disabled');
            $("#sub"+i).removeClass('btn-success');
            $("#can"+i).prop('disabled',true);
            $("#can"+i).addClass('btn-disabled');
            $("#can"+i).removeClass('btn-danger');
            $("#del"+i).prop('disabled',false);
            $("#del"+i).addClass('btn-danger');
            $("#del"+i).removeClass('btn-disabled');
        }
    }
}

function del(n){
    var len = <?php echo $len; ?>
    //fix this script so as to delete the specified entry..
    for (var i = 0; i <= len; i++){
        if (n == i){
            var value = confirm("Are you sure you want to do this?");
            if(value == true) {
                document.getElementById('sp_id').value = document.getElementById('sp_id'+i).value;
                document.del_form.submit();
            };
        }
    }
}

function sub(n){
    var len = <?php echo $len; ?>
    //fix this script so as to delete the specified entry..
    for (var i = 0; i <= len; i++){
        if (n == i){
            var val = confirm("Are you sure you want to do this?");
            if(val == true) {
                document.getElementById('sp_id').value = document.getElementById('sp_id'+i).value;
                document.getElementById('sp_name').value = document.getElementById('sp_name'+i).value;
                document.getElementById('sp_phone').value = document.getElementById('sp_phone'+i).value;
                document.getElementById('sp_class').value = document.getElementById('sp_class'+i).value;
                document.data_form.submit();
            };
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
                    <a class="navbar-brand" href="logs.php">Emergency logs</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#">
                                <i class="fa fa-users"></i>
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
                                <h4 class="title">Emergency Service Providers</h4>
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
                                    <form method="post" action="formsHandle.php" id="del_form" name="del_form">
                                    <input type="hidden" id="pageID" name="pageID" value="agents">
                                    <input type="hidden" id="category" name="category" value="DEL">
                                    <input type="hidden" id='sp_id' name='sp_id' value=''>
                                    </form>

                                    <form method="post" action="formsHandle.php" id="data_form" name="data_form">
                                    <input type="hidden" id="pageID" name="pageID" value="agents">
                                    <input type="hidden" id="category" name="category" value="UPD">
                                    <input type="hidden" id="adminID" name="adminID" value="100001">
                                    <input type="hidden" id='sp_id' name='sp_id' value=''>
                                    <input type="hidden" id='sp_name' name='sp_name' value=''>
                                    <input type="hidden" id='sp_class' name='sp_class' value=''>
                                    <input type="hidden" id='sp_phone' name='sp_phone' value=''>
                                    </form>

                                    <form method="post" action="">
                                    <input type="hidden" id="len" name="len" value="<?= $len; ?>">
                                        <table class="table table-hover" id="ems">
                                            <thead>
                                                <tr class="info">
                                                    <th> # </th>
                                                    <th> Id </th>
                                                    <th> Name </th>
                                                    <th> Classification </th>
                                                    <th> Phone Number </th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $var = 1;
                                            while ($stmt = $statement->fetch(PDO::FETCH_ASSOC)){
                                            echo ("
                                            <tr id='row".$var."' name='row".$var."'>
                                            <td> ".$var." </td>
                                            <td><input class='form-control' id='sp_id".$var."' name='sp_id".$var."' value='".$stmt['sp_id']. "' readonly='readonly'></td>
                                            <td><input class='form-control' id='sp_name".$var."' name='sp_name".$var."' value='".$stmt['sp_name']. "' readonly='readonly'></td>
                                            <td><input class='form-control' id='sp_class".$var."' name='sp_class".$var."' value='".$stmt['sp_class']. "' readonly='readonly'></td>
                                            <td><input class='form-control' id='sp_phone".$var."' name='sp_phone".$var."' value='".$stmt['sp_phone']. "' readonly='readonly'></td>
                                            <td> <button type='button' class='btn btn-group btn-group-sm btn-primary' onclick='edit(".$var.")'><i class='fa fa-pencil'></i></button>
                                                <button class='btn btn-group btn-group-sm btn-disabled' type='button' onclick='sub(".$var.")' id='sub".$var."' name='sub".$var."' disabled='disabled'><i class='fa fa-save'></i></button>
                                                <button class='btn btn-group btn-group-sm btn-disabled' type='button' id='can".$var."' name='can".$var."' disabled='disabled' onclick='cancel(".$var.")'><i class='fa fa-close'></i></button> 
                                                <button type='button' class='btn btn-group btn-group-sm btn-danger' id='del".$var."' name='del".$var."'  onclick='del(".$var.")'><i class='fa fa-trash'></i></button>
                                            </td>
                                            </tr>
                                            ");
                                            $var++; 
                                            } ?>
                                            </tbody>
                                        </table>
                                    </form>
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