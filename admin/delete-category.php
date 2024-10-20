<?php
// include constants file 
include('../config/constants.php');

   // check whether the id and image_name value is set or not 
   if(isset($_GET['id']) AND isset($_GET['image_name']))
   {
    // get the value and delete 
    echo"get value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // remove phisical image file is available 
    if($image_name != "")
    {
        // so emage is available remove it 
        $path = "../images/category/".$image_name;
        // remove the image
        $remove = unlink($path);

        // if falled to remove image then add a error massage and stop the process
        if($remove==FALSE)
        {
            // set the session massage
            $_SESSION['remove']="<div class='error'>Failed to remove catagory image </div>";
            // redirect to manage catagory page 
            header('location:'.SITEURL.'admin/manage-category.php');
            // stop the process 
            die();
        }

    }

    // delete data from database
    // sql query to delete data from database 
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    // execute the query 

    $res = mysqli_query($conn,$sql);
    // check ehether the data is deleted from data base or not 
    if($res==TRUE)
    {
        // set success massage and redirect
        $_SESSION['delete']="<div class='success'>Category Deleted Succesfully...</div>";
        // redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        // set error massage and redirect 
         // set failed massage and redirect
         $_SESSION['delete']="<div class='error'>Failed to Delete Category...</div>";
         // redirect to manage category
         header('location:'.SITEURL.'admin/manage-category.php');
    }

   
   }
   else
   {
    // redirect to manage category pge 
    header('location:'.SITEURL.'admin/manage-category.php');
   }
?>