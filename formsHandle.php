<?php
/**
 * Created by PhpStorm.
 * User: Pelumi
 * Date: 1/30/18
 * Time: 9:33 AM
 */
session_start();
require 'local_config.php';

//This is for all the pages that have to create or update any data in their system.

$userId = $_POST['user'];
$formId = $_POST['formId'];

switch ($userId) {
    case "root":

        if($_POST["formId"] == 'addCompany') {
            if (isset($_POST['sub'])) {
                $username = $_POST['nameId'];
                $pass = md5($_POST['pass']);
                $name = $_POST['name'];
                $email = $_POST['mail'];
                $phone = $_POST['tel'];
                $country = $_POST['country'];
                $state = $_POST['state'];
                $userID = $_POST['userId'];
                $prefix = $_POST['prefix'];


                $query = "INSERT INTO operators (id, username, password, prefix, level, names, email, phone, state, country, status)
                          VALUES ('$userID', '$username' , '$pass', '$prefix', '9', '$name', '$email', '$phone', '$state', '$country', '1')";
                $response = @mysqli_query($dbc, $query);

                if ($response) {
                    $_SESSION['message'] = "Company Added Successfully";
                    $_SESSION['report']='1';
                    header('location: home.php');
                } else {
                    $_SESSION['message'] = "There was an error processing your request. Please Try again";
                    $_SESSION['report']='0';
                    header('location: home.php');
                }
            }
        }

        else {
            if (isset($_POST['sub2'])) {
                $username = $_POST['nameId'];
                $pass = md5($_POST['pass']);
                $name = $_POST['name'];
                $email = $_POST['mail'];
                $phone = $_POST['tel'];
                $state = $_POST['state'];
                $userID = $_POST['userID'];


                $query = "INSERT INTO admin_users (id, username, password, name, level, email, phone, state, status)
                          VALUES ('$userID', '$username' , '$pass', '$name', '1', '$email', '$phone', '$state', '1')";
                $response = @mysqli_query($dbc, $query);

                if ($response) {
                    $_SESSION['message'] = "Root Admin Added Successfully";
                    $_SESSION['report']='1';
                    header('location: home.php');
                } else {
                    $_SESSION['message'] = "There was an error processing your request. Please Try again";
                    $_SESSION['report']='0';
                    header('location: home.php');
                }
            }
        }

        mysqli_close($dbc);
        break;


}
