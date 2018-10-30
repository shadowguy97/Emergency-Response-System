<?php
require_once 'local_config.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['login'])){
        require 'formsHandle.php';
    }
}

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
    <div class="col-md-12">
        <div class="login-card"><img src="assets/img/avatar_2x.png" class="profile-img-card">
            <p class="profile-name-card"> </p>
            <form  class="form-signin" action="log.php" method="post" id="loginForm" name="loginForm">
                <span class="reauth-email"> </span>
                <input class="form-control" type="email" required="" placeholder="Staff ID" autofocus="" id="inputEmail">
                <input class="form-control" type="password" required="" placeholder="Password" id="inputPassword">
                <div class="checkbox">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">Remember me</label>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg btn-signin" type="submit">Sign in</button>
            </form><a href="#" class="forgot-password">Forgot your password?</a></div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>