<?php 
/**
 * User: Pelumi
 * Date: 29/10/18
 * Time: 3:20 PM
 */

session_start();
include_once "resource/Database.php";
include_once "resource/utilities.php";

print_r($_SESSION);

$var = "admin";

$msg = $_SESSION['message'];
$rep = $_SESSION['report'];

$rootID = 0;
$query = 'SELECT COUNT(*) FROM admin;';
$statement = $db->prepare($query);
$statement->execute();
$data = $statement->fetchAll();
$Var_Id = $data[0]['COUNT(*)'];
if($Var_Id == 0) {
    $rootID = 100001;
}

if($Var_Id != 0){ 
    
    $Var_Id = $Var_Id + 100001;
    $tempID = $Var_Id;
    
    $query2 = 'SELECT admin_id FROM admin WHERE admin_id = :tempID;';
    $statement2 = $db->prepare($query2);
    $statement2->execute(array(
        ':tempID' => $tempID));
    $data2 = $statement2->fetchAll();
    $var2 = $data2[0]['admin_id'];

    if($var2 != $tempID) {
        $rootID = $tempID;
    }
    if($var2 == $tempID){
        $tempID = $tempID + 1;
        $rootID = $tempID;
    }
}

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

    <!-- sweet alerts -->
    <script src="assets/js/sweetalert.min.js"></script>

</head>
<body>
<script language="javascript" type="text/javascript">

    function checkForm()
    {
        if(document.adminForm.fName.value == '') {
            try {
            swal('Error', 'Please fill your first name field.', 'error');
            } catch (err) {
                alert( "Please fill your first name field.");
            }
            document.adminForm.fName.focus() ;
            $("#sub").show();
            $("#load").hide();
            return false;
        }
        if(document.adminForm.lName.value == '') {
            try {
            swal('Error', 'Please fill your last name field.', 'error');
            } catch (err) {
                alert( "Please fill your last name field.");
            }
            document.adminForm.lName.focus() ;
            $("#sub").show();
            $("#load").hide();
            return false;
        }
        if(document.adminForm.email.value == '') {
            try {
            swal('Error', 'Please fill in your email address.', 'error');
            } catch (err) {
                alert( "Please fill in your email address.");
            }
            document.adminForm.email.focus() ;
            $("#sub").show();
            $("#load").hide();
            return false;
        }
        if (document.adminForm.phone.value == '') {
            try {
            swal('Error', 'Please input your phone number.', 'error');
            } catch (err) {
                alert( "Please input your phone number.");
            }
            document.adminForm.phone.focus() ;
            $("#sub").show();
            $("#load").hide();
            return false;
        }
        if (document.adminForm.SID.value == '') {
            try {
            swal('Error', 'Staff ID is empty.', 'error');
            } catch (err) {
                alert( "Staff ID is empty.");
            }
            document.adminForm.SID.focus() ;
            $("#sub").show();
            $("#load").hide();
            return false;
        }
        if(document.adminForm.pass.value == "") {
            try {
            swal('Error', 'Please enter your password', 'error');
            } catch (err) {
                alert( "Please enter your password");
            }
            document.adminForm.pass.focus() ;
            $("#sub").show();
            $("#load").hide();
            return false;
        }
        if(document.adminForm.rpass.value == "") {
            try {
            swal('Error', 'Please repeat your password', 'error');
            } catch (err) {
                alert( "Please repaet your password");
            }
            document.adminForm.rpass.focus() ;
            $("#sub").show();
            $("#load").hide();
            return false;
        }
        if(document.adminForm.pass.value != document.adminForm.rpass.value) {
            try {
            swal('Error', 'Password do not match', 'error');
            } catch (err) {
                alert( "Password do not match");
            }
            document.adminForm.rpass.focus() ;
            $("#sub").show();
            $("#load").hide();
            return false;
        }
        return true;
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
                <?php
                if (isset($msg) && $rep == "1"){
                    echo("
                    <div class=\"col-md-12 text-center container-fluid\" style= \"background-color: #32CD32; color: black;\">
                         ".$msg."
                    </div>");
                }

                if (isset($msg) && $rep == "0"){
                    echo("
                    <div class=\"col-md-12 text-center container-fluid\" style= \"background-color: red; color: black;\">
                         ".$msg."
                    </div>");
                }
                    ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Registeration Form for new Admin</h4>
                            </div>

                            <div class="content">
                                <form method="post" action="formsHandle.php" name="adminForm" id="adminForm" onsubmit="return(checkForm());">
                                <input type="hidden" id="category" name="category" value="adminForm">
                                <input type="hidden" id="pageID" name="pageID" value="admin">
                                    <div class="form-group">
                                        <div class="col-sm-4 label-column">
                                            <label  for="name-input-field">First Name </label>
                                        </div>
                                        <div class="col-sm-6 input-column">
                                            <input class="form-control" type="text" id="fName" name="fName">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 label-column">
                                            <label  for="name-input-field">Last Name </label>
                                        </div>
                                        <div class="col-sm-6 input-column">
                                            <input class="form-control" type="text" id="lName" name="lName">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 label-column">
                                            <label  for="name-input-field">Phone Number </label>
                                        </div>
                                        <div class="col-sm-6 input-column">
                                            <input class="form-control" type="text" id="tel" name="tel">
                                        </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 label-column">
                                            <label  for="name-input-field">Staff ID</label>
                                        </div>
                                        <div class="col-sm-6 input-column">
                                            <input class="form-control" value="<?php echo $rootID; ?>" type="number" id="SID" name="SID" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 label-column">
                                            <label  for="email-input-field">Email </label>
                                        </div>
                                        <div class="col-sm-6 input-column">
                                            <input class="form-control" type="email" id="mail" name="mail">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 label-column">
                                            <label  for="pawssword-input-field">Password </label>
                                        </div>
                                        <div class="col-sm-6 input-column">
                                            <input class="form-control" type="password" id="pass" name="pass">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 label-column">
                                            <label  for="repeat-pawssword-input-field">Repeat Password </label>
                                        </div>
                                        <div class="col-sm-6 input-column">
                                            <input class="form-control" type="password" id="rpass" name="rpass">
                                        </div>
                                    </div>
                                    <button type="submit" id="sub" name="sub" class="btn btn-danger btn-block">Submit</button>
                                        <div id="load" style="display: none" class="text-center">
                                            <img src="assets/img/loading.gif" alt="load">
                                        </div>
                                </form>
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
unset($_SESSION['message']);?>
</html>