<?php
/**
 * Created by PhpStorm.
 * User: pelumi
 * Date: 10/30/17
 * Time: 11:14 AM
 */

session_start();
session_destroy();
if(session_destroy()) {
    header("Location: login.php");
}
