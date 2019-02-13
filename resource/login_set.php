<?php
include_once "Database.php";

if (isset($_POST['username']) && $_POST['password']){
    if (isset($_POST['login_sbt'])) {
            $username = $_POST['username'];
            $pass = md5($_POST['password']);
                
            try{
                # CHECK IF THE ID RETREVIED EXISTS IN THE DATABASE OR NOT
                $sqlQuery = "SELECT * FROM ems_db.admin WHERE id = :id";
                $statement=$db->prepare($sqlQuery);
                $statement->execute( array(
                    ':id' => $username
                ));
                
                if ($row = $statement->fetch()) {# i.e user exists
                    $password = $row['password'];
                    
                    if($pass == $password){
                        //user exist and can proceed futher.
                        $_SESSION['Fname'] = $row['admin_fname'];
                    }

                    $isValid = true;
                    header('location: ../dashboard.php');

                }
                else{# no such user exists
                        # so cookie id is invalid and -->DESTROY THE SESSION AND LOGOUT THE USER
                    echo popupMessage('Oops..',"this Username does not exists in our database",'error','login.php');
                    $isValid = false;
                    header('location: ../login.php');
                }
            }
            catch(PDOException $ex){
                echo popupMessage('Oops..', "something went wrong ,WHILE CHECKING THE USER'S ID IN THE DATABASE,".$ex->getMessage(),'error','login.php');
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

function popupMessage($title, $text, $type, $page){ # scripts included above
    $message ="<script type='text/javascript'>
                swal({
                    title: '{$title}',
                    text: '{$text}',
                    timer: 6000,
                    type: '{$type}',
                    showConfirmButton: false
                });
                setTimeout(function(){
                    window.location.href='{$page}'; 
                    }, 5000);
                </script>";
    
    $_SESSION['msg'] = $message;
    return $message;

}

?>

