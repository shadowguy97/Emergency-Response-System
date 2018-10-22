<?php
/**
 * Created by PhpStorm.
 * User: Pelumi
 * Date: 1/24/18
 * Time: 3:17 PM
 */

require_once 'local_config.php';
session_start();

$query = 'SELECT * FROM operators';
$response = @mysqli_query($dbc, $query);

$row_cnt = $_SESSION['row_cnt'];
$page = $_POST['pagename'];
if(isset($page) && $page != ""){
    $request = "SELECT * FROM operators WHERE id='$page'";
    $reply = @mysqli_query($dbc, $request);
}

$name;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotto board</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/light-bootstrap-dashboard.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-1.12.4.js"></script>
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="../css/animate.css" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="LOTTO" />
    <!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Montserrat+Alternates:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <!--//fonts-->
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../assets/css/bootstrap-toggle.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/phanimate.css">
    <script src="../assets/js/bootstrap%20toogle.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

</head>

<body>
<script type="text/javascript">
    function checkForm()
    {
        if (document.editUser.userId.value == '') {
            alert( "Please input the Admin ID!" );
            document.editUser.userId.focus() ;
            return false;
        }

        if(document.editUser.pass.value == '') {
            alert( "Please fill the password field" );
            document.editUser.pass.focus() ;
            return false;
        }

        if(document.editUser.pass2.value == '') {
            alert( "Please confirm password!" );
            document.editUser.pass2.focus() ;
            return false;
        }

        if(document.editUser.pass2.value != document.editUser.pass.value) {
            alert( "Password does not match!" );
            document.editUser.pass2.focus() ;
            document.editUser.pass.focus() ;
            return false;
        }


        if (document.editUser.nameId.value == '') {
            alert( "Please input Username!" );
            document.editUser.nameId.focus() ;

            return false;
        }
        if (document.editUser.name.value == '') {
            alert( "Please input the company name!" );
            document.editUser.name.focus() ;

            return false;
        }
        else if(document.editUser.mail.value == '') {
            alert( "Please input the company email address!" );
            document.editUser.mail.focus() ;

            return false;
        }
        if (document.editUser.tel.value == '') {
            alert( "Please input the company phone number!" );
            document.editUser.tel.focus() ;

            return false;
        }

        if (document.editUser.tel.value.length < 11 || document.editUser.tel.value.length > 13) {
            alert( "Please input a correct phone number!" );
            document.editUser.tel.focus() ;

            return false;
        }

        if (document.editUser.country.value == '') {
            alert( "Please select a country!" );
            document.editUser.country.focus() ;

            return false;
        }

        if (document.editUser.state.value == '') {
            alert( "Please select a state!" );
            document.editUser.state.focus() ;

            return false;
        }
        return true;
    }

</script>

<div>
    <nav class="navbar navbar-default navigation-clean-button" id="navBar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="home.php">Lotto Platform Management</a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <p class="navbar-text navbar-right actions">
                    <button class="btn btn-disabled action-button">
                        <span class="fa fa-user"></span>Hello <?php print_r ($_SESSION['name']); ?>
                    </button>
                    <a class="btn btn-default action-button" role="button" href="#" style="background: #e51c23;"><span class="fa fa-sign-out"></span> Logout</a>
                </p>
            </div>
        </div>
    </nav>
</div>

<style>
    #myNav > li {
        padding: 10px;
        border: #0b0b0b;
        border-width: medium;
        margin-top: 5px;
        margin-bottom: 5px;
        border-radius: 5%;
    }

    .active{
        background: rgba(222,222,222,0.72)
    }
</style>

<div class="wrapper">
    <!-- sidebar start -->
    <div class="sidebar" data-image="../assets/img/14.jpg">

        <div class="sidebar-wrapper">
            <ul class="nav" id="myNav">
                <?php
                $i;
                while ($row = mysqli_fetch_array($response)){
                    if ($page == $row['id']){
                        $i = 1;
                        $name = $row['names'];
                        echo ("
                           <li class='active'>
                                <form action='' method='post' id='form". $i ."' name='form". $i ."'>                           
                                    <input type='hidden' name='pagename' id='pagename' value=" .$row['id'] .">
                                    <a href=\"javascript:$('#form". $i ."').submit();\" style='color:black'>
                                        <i class=\"fa fa-users\" style=\"color: black;\"></i>
                                        <p>" . $row['names'] . "</p>
                                    </a>
                                </form>
                           </li>
                        ");
                    }
                    else{
                        $a = rand(1,100);
                        echo ("
                           <li>
                               <form action='' method='post' id='form". $a ."' name='form". $a ."'>
                                    <input type='hidden' name='pagename' id='pagename' value=" .$row['id'] .">
                                    <a href=\"javascript:$('#form". $a ."').submit();\" style='color:white'>
                                        <i class=\"fa fa-user\" style=\"color: black;\"></i>
                                        <p>" . $row['names'] . "</p>
                                    </a>
                                </form>
                           </li>
                        ");
                    }
                }

                ?>
            </ul>
        </div>
    </div>
    <!-- sidebar end -->

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
                    <a class="navbar-brand" href="#" style="text-transform: capitalize;">Manage <?= $name; ?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        echo("
                            <li>
                                <form action='stats.php' method='post' id='form' name='form'>
                                    <input type='hidden' name='pagename' id='pagename' value=".$page.">
                                       <a href=\"javascript:$('#form').submit();\" style=\"color: #2b2b2b; width:100px\" class=\"btn btn-info\" role=\"button\">
                                            <i class=\"fa fa-bar-chart\" style=\"color: black;\"></i>
                                            Stats
                                       </a>
                                </form>
                            </li>
                            ");
                        ?>
                        <li>
                            <a style="color: #2b2b2b;" class="btn btn-info" role="button" data-toggle="modal" data-target="#editUsers">
                                <span class="fa fa-pencil-square"></span> Edit Profile
                            </a>
                        </li>
                        <li>
                            <form action="" method="post">
                                <input type="checkbox" checked data-toggle="toggle" data-width="150" data-height="40" data-onstyle="success" data-offstyle="danger" data-on="Activated" data-off="Deactivated">
                            </form>
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
                    <div class="col-md-4 card">
                        <div class="header text-center">
                            <img class="img-responsive" src="../assets/img/merchants-grey.png">
                        </div>
                        <div class="content">
                            <?php
                            while ($row = mysqli_fetch_array($reply)) {
                                echo("
                                <p>Name: ". $row['names'] ."</p>
                                <p>Email: ". $row['email'] ."</p>
                                <p>Phone: ". $row['phone'] ."</p>
                                <p>Location: ". $row['state'] ."  ". $row['country'] ."</p>
                            ");
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-8 card">
                        <div class="header text-center">
                            <h2> Overview </h2>
                        </div>
                        <div class="content">
                            <p><strong>Total No of Merchants: </strong> 3 </p>
                            <p><strong>Total No of User: </strong> 10 </p>
                            <p><strong>Cost of Tickets: </strong> &#8358; 300 </p>
                            <p><strong>Total No of Ticket Sales per Day: </strong> 300 </p>
                        </div>
                    </div>

                </div>
            </div>


            <div class="footer-basic">
                <footer>
                    <p class="copyright">Nigeria Lotto Services © 2018</p>
                </footer>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel"><span class="fa fa-3x fa-user"></span>Edit Company</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="formsHandle.php" class="animated" method="post" onsubmit="return(checkForm());" id="editUser" name="editUser">
                                    <div class="col-md-6">
                                        <input type="hidden" id="formId" name="formId" value="editCompany">
                                        <input type="hidden" id="user" name="user" value="root">

                                        <div class="form-group">
                                            <label for="userId"> User ID: </label>
                                            <input type="text" class="form-control" id="userId" name="userId" readonly="readonly" value="<?= $userID; ?>">
                                        </div>

                                        <div class="custom-input">
                                            <input required type="text" class="form-control" id="nameId" name="nameId" placeholder="Username">
                                        </div>

                                        <div class="custom-input">
                                            <input required type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                                        </div>

                                        <div class="custom-input">
                                            <input required type="email" class="form-control" id="mail" name="mail" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <label for="country">Country :</label>
                                            <select class="form-control" id="country" name="country"></select>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userId"> Merchant Prefix: </label>
                                            <input type="text" class="form-control" id="prefix" name="prefix" readonly="readonly" value="<?= $prefix; ?>">
                                        </div>

                                        <div class="custom-input">
                                            <input required type="text" class="form-control" id="name" name="name" placeholder="Name">
                                        </div>

                                        <div class="custom-input">
                                            <input required type="password" class="form-control" id="pass2" name="pass2" placeholder="Verify Password">
                                        </div>

                                        <div class="custom-input">
                                            <input type="text" class="form-control" id="tel" name="tel" placeholder="Phone Number" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="state">State :</label>
                                            <select class="form-control" id="state" name="state"></select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" id="sub" name="sub" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                <form action="" method="post">
                    <cite>Please note that this cannot be reversed</cite>
                    <button type="submit" id="del" name="del" class="btn btn-danger btn-block">Delete Profie </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-1.12.4.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/phanimate.jquery.js"></script>
<script type="text/javascript" src="../assets/js/countries.js"></script>
<script language="javascript">
    populateCountries("country", "state");
</script>

</body>
</html>