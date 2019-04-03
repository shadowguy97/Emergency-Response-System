<?php
session_start();
include_once "Database.php";

if (isset($_POST['username']) && $_POST['password']){
    if (isset($_POST['login_sbt'])) {
        $username = $_POST['username'];
        $pass = md5($_POST['password']);
            
        try{
            # CHECK IF THE ID RETREVIED EXISTS IN THE DATABASE OR NOT
            $sqlQuery = "SELECT * FROM admin WHERE admin_id = :id";
            $stmt = $db->prepare($sqlQuery);
            $stmt->execute( array(
                ':id' => $username
            ));
                
            $row = $stmt->fetch();

            if ($row['admin_id'] == $username) {# i.e user exists
                $password = $row['password'];
                    
                if($pass == $password){
                    //user exist and can proceed futher.
                    $_SESSION['fullname'] = $row['admin_fname'];
                    $_SESSION['eType'] = $row['eType'];
                    header('location: ../dashboard.php');
                }
                else{# no such user exists
                    # so cookie id is invalid and -->DESTROY THE SESSION AND LOGOUT THE USER
                    $_SESSION['message'] = "Oops.. this Username or Password does not exists in our database";
                    $_SESSION['report'] = '0';
                    header('location: ../login.php');
                }
            }

            else{# no such user exists
                # so cookie id is invalid and -->DESTROY THE SESSION AND LOGOUT THE USER
                $_SESSION['message'] = "Oops.. this Username or Password does not exists in our database";
                $_SESSION['report'] = '0';
                header('location: ../login.php');
            }
        }
        catch(PDOException $ex){
                $_SESSION['message'] = "Oops..something went wrong while checking the userID in our database, " .$ex->getMessage();
                $_SESSION['report']='0';
                header('location: ../login.php');
        }# end try-catch 
    }
}


function _token(){
	$randomToken = base64_encode(openssl_random_pseudo_bytes(32))."open ssl<br>"; # --> this will generate a random token for us ..   32 is the bytes  
	# another way
	//echo $randomToken = md5(uniqid(rand(),true))."md5"; # uniqid --> is a builtin function provided by php only  --> not much secure 
	$_SESSION['token'] = $randomToken;
	
	return $_SESSION['token'];
}

function validate_token($requestToken){
	if( isset($_SESSION['token']) && $requestToken === $_SESSION['token'] ){ # ie. if it is not set thet means request is coming from a third party (HACKER ALERT !)
		unset($_SESSION['token']);
		return true;
	}
	return false; # by default it will return false if we found thta the session variable is not set...

}

?>

