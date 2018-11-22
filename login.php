<?php
session_start();
include_once "resource/Database.php";
include_once "resource/utilities.php";

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
        <div class="col-md-6 text-center">
            <?php  if (isset($result) ) echo $result;      # these are for successfull AND unsuccessful  messages  ?>	
            <?php if (!empty($form_errors) )  echo show_errors($form_errors); # these are for error messages  ?>
        </div>
        <div class="col-md-6">
        <form action="" method="post" >
            <div class="form-group">
                <label for="usernameField1">Username:</label>
                <input type="text" class="form-control" name="username"  id="usernameField1" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password1">Password:</label>
                <input type="password" class="form-control" name="password" id="password1" placeholder="Password">
            </div>
            <div class="checkbox">
                <label>
                <input type="checkbox" checked="true" value="yes" name="remember">Remember me. <!--the value 'yes' will be sent when it is set and the form is submitted , so in the $_POST['remember']-->
                </label>
            <input type="hidden" name="token" value="<?php echo _token(); ?>">
                <button type="submit" class="btn btn-primary pull-right" name="login_sbt">Sign in</button>
            </div>	
            <br>
            <a href="password_recovery.php">Forgot password ?</a>  <!-- previous recovery page  ->  forgot_password .php -->
        </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>