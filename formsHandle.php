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

$pageId = $_POST['pageID'];

switch ($pageId) {
    case "admin":

            if (isset($_POST['sub'])) {
                $fName = $_POST['fName'];
                $pass = md5($_POST['pass']);
                $lName = $_POST['lName'];
                $email = $_POST['mail'];
                $phone = $_POST['tel'];
                $SID = $_POST['SID'];
                
                
                $query = "INSERT INTO admin (admin_id, admin_fname, admin_lname, admin_phone, admin_email, password)
                          VALUES ('$SID', '$fName', '$lName' , '$phone', '$email', '$pass')";
                $response = @mysqli_query($dbc, $query);

                if ($response) {
                    $_SESSION['message'] = "Admin Added Successfully";
                    $_SESSION['report']='1';
                    header('location: reg.php');
                } else {
                    $_SESSION['message'] = "There was an error processing your request. Please Try again";
                    $_SESSION['report']='0';
                    header('location: reg.php');
                }
            }



        mysqli_close($dbc);
        break;


}
