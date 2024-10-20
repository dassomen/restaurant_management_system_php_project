<?php
// include constants file 
include('../config/constants.php');

if(isset($_GET['id'])&& isset($_GET['image_name']))
{
    // process to delete 
    //1. get id and image name

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2. removed the image if available

    // check whether the image are available or not and delete only if available 

    if($image_name != "")
    {
        //it has image and need to remove folder
        // get the image path
        $path = "../images/food/".$image_name;

        // removed image file from folder

        $remove = unlink($path);

        // check whether the image is removed or not 

        if($remove == FALSE)
        {
            // failed to remove image 
            $_SESSION['upload']="<div class='error'>Failed to Removed Image File</div>";
            //redirect to manage food page 
            header('location:'.SITEURL.'admin/manage-food.php');
            //stop the process
            die();
        }
    }

    //3. delete food from database
    $sql="DELETE FROM tbl_food WHERE id=$id ";
    // execute the query
    $res = mysqli_query($conn,$sql);
    // check the query sessecfully executed or not and set the session massage 
    if($res==TRUE)
    {
        // food deleted
        $_SESSION['delete']="<div class='success'>Food Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        // falled to deleted food 
        $_SESSION['delete']="<div class='error'>Failed to Delete Food</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

    // 4. redirect to manage food with session masage 
}
else
{
    // redirect with manage food
    $_SESSION['Unauthorized']="<div class='error'>Unauthorized access</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>