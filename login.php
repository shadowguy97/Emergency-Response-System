<?php
require_once 'local_config.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['sub'])){
        require 'log.php';
    }
}
?>

<!doctype html>
<html lang="!">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>
    <!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Montserrat+Alternates:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <!--//fonts-->
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/phanimate.css">


    <title>Lotto agencies : Login</title>
</head>
<body style="background: url(../assets/img/background.jpg); background-repeat: no-repeat; background-size: cover;">

<style type="text/css">
    #login{
        border: #0b0b0b;
        border-radius: 5%;
        border-width: 5px;
        background: rgba(222, 222, 222, 0.96);
        margin-top: 10%;
    }

    #login > div > p {
        font-style: italic;
        padding-top: 8px;
    }

    #msg{
        background: red;
        color: white;
        border-radius: 5%;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" id="login">
            <div class="text-center">
<!--                <img src="../assets/img/National-Lottery-Regulatory-Commission.jpg" alt="" class="img-responsive"> -->

                <?php
                if(isset($_SESSION['message']) AND !empty($_SESSION['message'])){
                    echo("<script>
                $('#userName').addClass('shake');
                $('#pass').addClass('shake');
                </script>
                ");
                echo("<div class=\"col-md-12\" id=\"msg\">
                    <p><span class=\"fa fa-warning\"></span> ") . $_SESSION['message'];
                    echo("</p> </div>
                ");

                    unset($_SESSION['message']);
                }
                ?>
                <h2>Login</h2>
            </div>
            <div class="col-md-12">
                <form action="log.php" method="post" id="loginForm" name="loginForm">
                    <div class="custom-input">
                        <input required type="text" class="form-control  animated" id="userName" name="userName" placeholder="Username *">
                    </div>
                    <div class="custom-input">
                        <input required type="password" class="form-control  animated" id="pass" name="pass" placeholder="Password *">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="sub" name="sub" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



</body>

<!--   Core JS Files   -->
<script src="../assets/js/jquery-1.12.4.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/phanimate.jquery.js"></script>

</html>