<?php
/**
 * Created by PhpStorm.
 * User: Pelumi
 * Date: 1/29/18
 * Time: 12:37 PM
 */

DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'lottoking');

// Create connection
$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
or
die('Could not connect to Database' . mysqli_connect_error());
