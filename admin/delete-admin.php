<?php
// include constants.php file here

include('../config/constants.php');

//1. get the id of admin to be deleted
 $id=$_GET['id'];

//2. crete SQL query to delete admin

$sql="DELETE FROM tbl_admin WHERE id=$id";

// execute the query

$res= mysqli_query($conn,$sql);

// check whether the query succesfully executed or not
if($res==TRUE)
{
    //query executed succesfully and admin deleted
    //echo"Admin Deleted";

    // crete session to desplay massage 
    $_SESSION['delete']= "<div class='success'>Admin Deleted Succesfully</div>";
    //redirect to manage admin page 
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    //falled to delete admin
    //echo"Falled to Deleted Admin";
    $_SESSION['delete']= "<div class='error'>Failed to  Deleted Admin. Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//3. redirect to manage admin page with masage  (success/error)
?>