<?php
// athorization and access control
// cheked the user is logged in or not 
if(! isset($_SESSION['user']))// if user session is not set
{
    // user is not logged in
    // redirect to login page with massage
    $_SESSION['no-login-massage']="<div class='error text-center'>Plese login to access admin panel</div>";
    // redirect to login page 
    header('location'.SITEURL.'admin/login.php');
}
?>