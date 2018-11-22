<?php
/**
 * Created by PhpStorm.
 * User: Pelumi
 * Date: 1/29/18
 * Time: 12:37 PM
 */

$dsn = 'mysql:host = localhost;dbname=ems_db';
$username = 'root';
$password = '';

$host = 'localhost' ;
$dbname = 'ems_db';

try{  
    $db = new PDO($dsn,$username,$password);
    $db ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex){
        echo 'connetion failed<br/>'.$ex->getMessage();
    }
    