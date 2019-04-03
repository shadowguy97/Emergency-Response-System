<?php
session_start();
include_once "resource/login_set.php";

$msg = $_SESSION['message'];
$rep = $_SESSION['report'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>EMS: Emergency Medical System </title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="assets/css/Pretty-Header.css">
</head>

<body>
    <div class="col-md-12 col-sm-offset-0">
        <nav class="navbar navbar-default custom-header">
            <div class="container-fluid">
                <div class="navbar-header">
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
    <div class="container">
        <h2>Login form</h2>
        <div class="col-md-8">
            <div class="login-card"><img src="assets/img/avatar_2x.png" class="profile-img-card">
                <p class="profile-name-card"> </p>
                <form action="resource/login_set.php" method="post" >
                    <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username"  id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                            <input type="checkbox" checked="true" value="yes" name="remember">Remember me. <!--the value 'yes' will be sent when it is set and the form is submitted , so in the $_POST['remember']-->
                            </label>
                            <input type="hidden" name="token" value="<?php echo _token(); ?>">
                            <button type="submit" class="btn btn-primary pull-right" name="login_sbt" id="login_sbt">Sign in</button>
                        </div>	
                        <br>
                </form>
                <a href="password_recovery.php" class="forgot-password">Forgot password ?</a>  <!-- previous recovery page  ->  forgot_password .php -->
            </div>
        </div>
    
        <div class="col-md-4">
            <?php
                if (isset($msg) && $rep == "0"){
                    echo("
                        <div class=\"text-center container-fluid\" style= \"background-color: red; color: white; height: 30%; font-size: 30px; font-style: italic;\">
                        ".$msg."
                        </div>"
                    );
                }
            ?>
        </div>
    </div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<?php
unset($rep);
unset($_SESSION['report']);
unset($msg);
unset($_SESSION['message']);
?>

</body>
</html>