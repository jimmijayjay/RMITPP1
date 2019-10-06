<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 
    if(isset($_SESSION['s_email']) AND isset($_SESSION['s_forgetpassword_hash'])){ //user link has alreay been authenticated, display the form
         /*This should only happen when user submits form and there are validation errors*/
         include_once './tools/resetpassword_page_template.php';  
    }else{//user link has not been authenticated, perform authentication
         include_once './tools/resetpassword_auth_server.php';
         if (count($link_errors) === 0){ //link authentication is successful, display form
            /*store email and hash in session var in case there are password form input validation errors*/                         
            $_SESSION['s_email'] = $_GET['email'];
            $_SESSION['s_forgetpassword_hash'] = $_GET['forgetpassword_hash'];  
            include_once './tools/resetpassword_page_template.php';            
        }
     }
?>
