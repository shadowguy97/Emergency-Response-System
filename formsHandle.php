<?php
/**
 * Created by PhpStorm.
 * User: Pelumi
 * Date: 1/30/18
 * Time: 9:33 AM
 */
session_start();
include_once "resource/Database.php";
include_once 'resource/send-email-gmail.php';

//This is for all the pages that have to create or update any data in their system.

$pageId = $_POST['pageID'];

switch ($pageId) {

    case "activate":
    if(isset($_GET['id'])) {
		$encoded_id = $_GET['id'];
		$decode_id = base64_decode($encoded_id);
		$user_id_array = explode("encodeuserid", $decode_id);
		$id = $user_id_array[1];

		$sql = "UPDATE admin SET activated =:activated WHERE id=:id AND activated='0'"; # so if the account has been already updated then this script will not work

		$statement = $db->prepare($sql);
		$statement->execute(array(':activated' => "1", ':id' => $id));

		if ($statement->rowCount() == 1) {
			$result = "<div class=\"container\"  style=\"padding-top:25%\"><h2>Email Confirmed </h2>
			<p class='lead' style=\"padding-top:6px\">Your email address has been verified, you can now <a href=\"login.php\">login</a> with your email and password.</p></div>";
		} else {
			$result = "<div class=\"container\" style=\"padding-top:30%\"><p class='lead'>No changes made please contact site admin,
		    if you have not confirmed your email before</p></div>";
		}
	}
    break;

    case "admin":
        //this adds a new admin to the database.
        if (isset($_POST['category']) && $_POST['category'] == "adminForm"){
            if (isset($_POST['sub'])) {
                $fName = $_POST['fName'];
                $pass = md5($_POST['pass']);
                $lName = $_POST['lName'];
                $email = $_POST['mail'];
                $phone = $_POST['tel'];
                $SID = $_POST['SID'];
                $eType = $_POST['eType'];

                $token = openssl_random_pseudo_bytes(16);
                $token = bin2hex($token);
                
                try{
                    $sqlInsert = "INSERT INTO admin (admin_id, admin_fname, admin_lname, admin_phone, admin_email, password, activated, eType)
                                    VALUES  (:sid, :fName, :lName, :phone, :email, :password, :token, :eType)";

                    $statement = $db->prepare($sqlInsert);
                    $statement->execute( array(
                        ':sid' => $SID,
                        ':fName' => $fName, 
                        ':lName' => $lName,
                        ':password' => $pass,
                        ':email' => $email, 
                        ':phone' => $phone,
                        ':token' => $token,
                        ':eType' => $eType
                    ));

                    if($statement->rowcount()==1){ # ie if one row is changed theb ...
                        $user_id = $db->lastInsertId();
                        $encode_id = base64_encode("encodeUserid{$user_id}");
                        //prepare email body
                        $mail_body = '<html>
                                        <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                                                        line-height:1.8em;">
                                            <h2>User Authentication System </h2>
                                            <p>Dear '.$fName.' '.$lName.'<br><br>Thank you for registering, please click on the link below to
                                            confirm your email address</p>
                                            <p><a href="http://localhost/activate.php?id='.$encode_id.'"> Confirm Email</a></p>
                                            <p><strong>&copy;2016 Authentication System </strong></p>
                                        </body>
                                </html>';

                        $mail->addAddress($email, $fName); #  $email is necessary BUT $username is optional..
                        $mail->Subject = "message from Emergency Service Management System.";
                        $mail->Body = $mail_body;

                        $_SESSION['msg'] = "Admin Added Successfully<br>Please check your email for conformation link!";
                        $_SESSION['report'] = '0';
                        header('location: reg_admin.php');

                        // error handiling for PHPmailer
                        if ($mail->Send()) {
                            $_SESSION['message'] = "Admin Added Successfully<br>Please check your email for conformation link!";
                            $_SESSION['report'] = '1';
                            header('location: reg_admin.php');
                        }else{
                            $_SESSION['message'] = "Error: ".$mail->ErrorInfo;
                            $_SESSION['report'] = '1';
                            header('location: reg_admin.php');
                        }	
                    }else{
                        $_SESSION['message'] = "There was an error processing your request. Please Try again.";
                        $_SESSION['report']  = '0';
                        header('location: reg_admin.php');
                    }

                }catch(PDOException $ex){ // this will be the error from the conection and not from the user
                    $_SESSION['message'] = "An error occured: WHILE INSERTING THE FORM DATA INTO THE DATABASE==>".$ex->getMessage();
                    $_SESSION['report'] = '0';
                    header('location: reg_admin.php');
                    }
                }
        }
        
        //this adds a new service provider.
        if (isset($_POST['category']) && $_POST['category'] == "spForm"){
            if (isset($_POST['sub'])) {
                $name = $_POST['Name'];
                $class = $_POST['class'];
                $phone = $_POST['tel'];
                $sp_ID = $_POST['sp_id'];
                $adminID = $_POST['adminID'];
                
                try{
                    $sqlInsert = "INSERT INTO service_provider (sp_id, sp_name, sp_phone, admin_id, sp_class)
                                    VALUES  (:sp_id, :name, :phone, :sid, :class)";
                    $statement = $db->prepare($sqlInsert);
                    $statement->execute(
                        array(
                        ':sid' => $adminID,
                        ':name' => $name, 
                        ':class' => $class,
                        ':sp_id' => $sp_ID, 
                        ':phone' => $phone)
                    );

                    $_SESSION['message'] = "Service Provider Added Successfully";
                    $_SESSION['report'] = '1';
                    header('location: reg_operator.php');

                }
                catch(PDOException $ex){ // this will be the error from the conection and not from the user
                    $_SESSION['message'] = "An error occured: WHILE INSERTING THE FORM DATA INTO THE DATABASE==>".$ex->getMessage();
                    $_SESSION['report'] = '0';
                    header('location: reg_operator.php');
                }
            }
        }

        //This updates the database for the admins based on the changes made by the admin.
        if(isset($_POST['category']) && $_POST["category"] == "UPD"){
            
            $query = 'SELECT COUNT(*) FROM admin;';
            $sql_query = $db->prepare($query);
            $sql_query->execute();
            $data = $sql_query->fetchAll();
            $len = $data[0]['COUNT(*)'];

            $fname = $_POST['admin_fname'];
            $lname = $_POST['admin_lname'];
            $phone = $_POST['admin_phone'];
            $email = $_POST['admin_email'];
            $adminID = $_POST['admin_id'];
                        
            try{
                $sqlUpdate = "UPDATE admin SET admin_id=:admin_id, admin_fname=:fname, admin_lname=:lname, admin_phone=:phone, admin_email=:email WHERE admin_id=:admin_id";
                $statement = $db->prepare($sqlUpdate);
                $statement->execute( 
                    array(
                        'admin_id' => $adminID,    
                        'fname' => $fname,
                        'lname' => $lname, 
                        'phone' => $phone,
                        'email' => $email
                    )
                );
           
                $_SESSION['message'] = "Administrators Details Updated Successfully";
                $_SESSION['report'] = '1';
                header('location: admin.php');
           
            }
            catch(PDOException $ex){ // this will be the error from the conection and not from the user
                $_SESSION['message'] = "An error occured: WHILE UPDATING THE FORM DATA INTO THE DATABASE==>".$ex->getMessage();
                $_SESSION['report'] = '0';
                header('location: admin.php');
            }        
                   
       }
    
        
        //This delete the entry from database for the admins based on the changes made by the admin.
        if(isset($_POST['category']) && $_POST["category"] == "DEL"){           
            $admin_id = $_POST['admin_id'];
            try{
                $query = 'DELETE FROM admin WHERE admin_id = :admin_id';
                $sql_query = $db->prepare($query);
                $sql_query->execute(
                    array(
                        ':admin_id' => $admin_id
                    )
                );

                $_SESSION['message'] = "Administrator Deleted Successfully";
                $_SESSION['report'] = '1';
                header('location: admin.php');
            }
            catch(PDOException $ex){ // this will be the error from the conection and not from the user
                $_SESSION['message'] = "An error occured: WHILE DELETING THE FORM DATA FROM THE DATABASE==>".$ex->getMessage();
                $_SESSION['report'] = '0';
                header('location: admin.php');
            }
        }
    break;

    case "agents":
        $query = 'SELECT COUNT(*) FROM service_provider;';
        $sql_query = $db->prepare($query);
        $sql_query->execute();
        $data = $sql_query->fetchAll();
        $len = $data[0]['COUNT(*)'];

        //This case updates the database for the services based on the changes made by the admin.
         if($_POST["category"] == 'UPD'){    
            $name = $_POST['sp_name'];
            $class = $_POST['sp_class'];
            $phone = $_POST['sp_phone'];
            $sp_ID = $_POST['sp_id'];
            $adminID = $_POST['adminID'];
                         
            try{
                $sqlUPdate = "UPDATE service_provider SET sp_id=:sp_id, sp_name=:name, sp_phone=:phone, admin_id=:sid, sp_class=:class WHERE sp_id=:sp_id";
                $statement = $db->prepare($sqlUPdate);
                $statement->execute( 
                    array(
                        'sp_id' => $sp_ID, 
                        'name' => $name,
                        'phone' => $phone,
                        'sid' => $adminID,
                        'class' => $class
                    )
                );
            
                $_SESSION['message'] = "Service Provider Details Updated Successfully";
                $_SESSION['report'] = '1';
                header('location: services.php');
            
            }
            catch(PDOException $ex){ // this will be the error from the conection and not from the user
                $_SESSION['message'] = "An error occured: WHILE UPDATING THE FORM DATA INTO THE DATABASE==>".$ex->getMessage();
                $_SESSION['report'] = '0';
                header('location: services.php');
            }        
        }

        //This delete the entry from database for the admins based on the changes made by the admin.
       if(isset($_POST['category']) && $_POST["category"] == "DEL"){            
            $sp_id = $_POST['sp_id'];
            try{
                $query = 'DELETE FROM service_provider WHERE sp_id = :sp_id';
                $sql_query = $db->prepare($query);
                $sql_query->execute(
                    array(
                        ':sp_id' => $sp_id
                    )
                );

                $_SESSION['message'] = "Service Provider Deleted Successfully";
                $_SESSION['report'] = '1';
                header('location: services.php');
            }
            catch(PDOException $ex){ // this will be the error from the conection and not from the user
                $_SESSION['message'] = "An error occured: WHILE DELETING THE FORM DATA FROM THE DATABASE==>".$ex->getMessage();
                $_SESSION['report'] = '0';
                header('location: services.php');
            }
        }

    break;

    case "distress":
        if(isset($_POST['category']) && $_POST["category"] == "healthForm"){
            if (isset($_POST['sub'])) {
                $dcall_lat = $_POST['lat'];
                $dcall_lng = $_POST['lng'];
                $dcall_type = $_POST['type'];
                $phone = $_POST['tel'];
                $time = date("Y-m-d\ || G:i:s");
                $status = "Unattended";

                try{
                    $query = 'SELECT COUNT(*) FROM distress_call;';
                    $sql_query = $db->prepare($query);
                    $sql_query->execute();
                    $data = $sql_query->fetchAll();
                    
                    $len = $data[0]['COUNT(*)'];

                    if(isset($len) & $len == 0){
                        $dcall_id = 1;
                    }
                    else{
                        $dcall_id = 1 + $len;
                    }                    

                }catch(PDOException $ex){ // this will be the error from the conection and not from the user
                    $_SESSION['message'] = "An error occured while proceessing your request".$ex->getMessage(); //remove $ex->getMessage()
                    $_SESSION['report'] = '0';
                    header('location: index.php');
                }

                try{
                    
                    $sqlInsert = "INSERT INTO distress_call (dcall_id, dcall_lat, dcall_long, dcall_type, dcall_phone, dcall_time, dcall_status)
                                    VALUES  (:dcall_id, :dcall_lat, :dcall_lng, :dcall_type, :dcall_phone, :dcall_time, :dcall_status)";
                    $statement = $db->prepare($sqlInsert);
                    $statement->execute( array(
                        ':dcall_id' => $dcall_id,
                        ':dcall_lat' => $dcall_lat, 
                        ':dcall_lng' => $dcall_lng,
                        ':dcall_type' => $dcall_type,
                        ':dcall_phone' => $phone,
                        ':dcall_time' => $time,
                        ':dcall_status' => $status
                    ));

                    header('location: reply.php');

                }catch(PDOException $ex){ // this will be the error from the conection and not from the user
                    $_SESSION['message'] = "An error occured while proceessing your request".$ex->getMessage(); //remove $ex->getMessage()
                    $_SESSION['report'] = '0';
                    header('location: index.php');
                }
            }
        }   

        if(isset($_POST['category']) && $_POST["category"] == "fireForm"){
            if (isset($_POST['sub'])) {
                $dcall_lat = $_POST['lat'];
                $dcall_lng = $_POST['lng'];
                $dcall_type = $_POST['type'];
                $phone = $_POST['tel'];
                $time = date("Y-m-d\ || G:i:s");
                $status = "Unattended";

                try{
                    $query = 'SELECT COUNT(*) FROM distress_call;';
                    $sql_query = $db->prepare($query);
                    $sql_query->execute();
                    $data = $sql_query->fetchAll();
                    
                    $len = $data[0]['COUNT(*)'];

                    if(isset($len) & $len == 0){
                        $dcall_id = 1;
                    }
                    else{
                        $dcall_id = 1 + $len;
                    }                    

                }catch(PDOException $ex){ // this will be the error from the conection and not from the user
                    $_SESSION['message'] = "An error occured while proceessing your request".$ex->getMessage(); //remove $ex->getMessage()
                    $_SESSION['report'] = '0';
                    header('location: index.php');
                }

                try{
                    
                    $sqlInsert = "INSERT INTO distress_call (dcall_id, dcall_lat, dcall_long, dcall_type, dcall_phone, dcall_time, dcall_status)
                                    VALUES  (:dcall_id, :dcall_lat, :dcall_lng, :dcall_type, :dcall_phone, :dcall_time, :dcall_status)";
                    $statement = $db->prepare($sqlInsert);
                    $statement->execute( array(
                        ':dcall_id' => $dcall_id,
                        ':dcall_lat' => $dcall_lat, 
                        ':dcall_lng' => $dcall_lng,
                        ':dcall_type' => $dcall_type,
                        ':dcall_phone' => $phone,
                        ':dcall_time' => $time,
                        ':dcall_status' => $status
                    ));

                    header('location: reply.php');

                }catch(PDOException $ex){ // this will be the error from the conection and not from the user
                    $_SESSION['message'] = "An error occured while proceessing your request".$ex->getMessage(); //remove $ex->getMessage()
                    $_SESSION['report'] = '0';
                    header('location: index.php');
                }
            }
        }   

        if(isset($_POST['category']) && $_POST["category"] == "securityForm"){
            if (isset($_POST['sub'])) {
                $dcall_lat = $_POST['lat'];
                $dcall_lng = $_POST['lng'];
                $dcall_type = $_POST['type'];
                $phone = $_POST['tel'];
                $time = date("Y-m-d\ || G:i:s");
                $status = "Unattended";

                try{
                    $query = 'SELECT COUNT(*) FROM distress_call;';
                    $sql_query = $db->prepare($query);
                    $sql_query->execute();
                    $data = $sql_query->fetchAll();
                    
                    $len = $data[0]['COUNT(*)'];

                    if(isset($len) & $len == 0){
                        $dcall_id = 1;
                    }
                    else{
                        $dcall_id = 1 + $len;
                    }                    

                }catch(PDOException $ex){ // this will be the error from the conection and not from the user
                    $_SESSION['message'] = "An error occured while proceessing your request".$ex->getMessage(); //remove $ex->getMessage()
                    $_SESSION['report'] = '0';
                    header('location: index.php');
                }

                try{
                    
                    $sqlInsert = "INSERT INTO distress_call (dcall_id, dcall_lat, dcall_long, dcall_type, dcall_phone, dcall_time, dcall_status)
                                    VALUES  (:dcall_id, :dcall_lat, :dcall_lng, :dcall_type, :dcall_phone, :dcall_time, :dcall_status)";
                    $statement = $db->prepare($sqlInsert);
                    $statement->execute( array(
                        ':dcall_id' => $dcall_id,
                        ':dcall_lat' => $dcall_lat, 
                        ':dcall_lng' => $dcall_lng,
                        ':dcall_type' => $dcall_type,
                        ':dcall_phone' => $phone,
                        ':dcall_time' => $time,
                        ':dcall_status' => $status
                    ));

		     $_SESSION['long'] = $dcall_lng;
		     $_SESSION['lat'] = $dcall_lat;
		     $_SESSION['tel'] = $phone;
		     $_SESSION['time'] = $time;

                    header('location: reply.php');

                }catch(PDOException $ex){ // this will be the error from the conection and not from the user
                    $_SESSION['message'] = "An error occured while proceessing your request".$ex->getMessage(); //remove $ex->getMessage()
                    $_SESSION['report'] = '0';
                    header('location: index.php');
                }
            }
        }   

    break;

    case "dash":
        
        $query = 'SELECT COUNT(*) FROM distress_call;';
        $sql_query = $db->prepare($query);
        $sql_query->execute();
        $data = $sql_query->fetchAll();
        $len = $data[0]['COUNT(*)'];
    
        //This case updates the database for the services based on the changes made by the admin.
        if($_POST["category"] == 'UPD'){ 
            for($i = 1; $i <= $len; $i++){
                if(isset($_POST["sub".$i])){ 
                    $status = $_POST['dcall_status'.$i];
                    $id = $_POST['dcall_id'.$i];

                    try{
                        $sqlUPdate = "UPDATE distress_call SET dcall_status=:stat WHERE dcall_id=:dcall_id";
                        $statement = $db->prepare($sqlUPdate);
                        $statement->execute( 
                            array(
                                ':dcall_id' => $id, 
                                ':stat' => $status
                            )
                        );
                    
                        $_SESSION['message'] = "Details Updated Successfully";
                        $_SESSION['report'] = '1';
                        header('location: dashboard.php');
                    
                    }
                    catch(PDOException $ex){ // this will be the error from the conection and not from the user
                        $_SESSION['message'] = "An error occured: WHILE UPDATING THE FORM DATA INTO THE DATABASE==>".$ex->getMessage();
                        $_SESSION['report'] = '0';
                        header('location: dashboard.php');
                    }        
                }
            }
        }

    break;
}