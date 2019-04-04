<?php
/**
 * Created by PhpStorm.
 * User: Pelumi
 * Date: 1/29/18
 * Time: 12:37 PM
 */

/* $dsn = 'mysql:host = localhost;dbname=ems_db';
$username = 'root';
$password = ''; */

$dsn = 'mysql:host = localhost;dbname=ems_db';
$username = 'bd0f798143af87';
$password = '1b916786';

$host = 'us-cdbr-iron-east-03.cleardb.net' ;
$dbname = 'heroku_5ef1bac9c6ca945';

try{  
    $db = new PDO($dsn,$username,$password);
    $db ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex){
        echo 'connetion failed<br/>'.$ex->getMessage();
    }
    
