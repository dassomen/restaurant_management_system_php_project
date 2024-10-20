<?php include('partails/menu.php')  ?>

<div class="main-contant">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl_30">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>


                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>



<?php include('partails/footer.php')  ?>


<?php
//  check whether the submit button is clicked or not 
if(isset($_POST['submit']))
{
    //echo "Clicked";

    // 1. get the data from the form 
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    // 2. check whwther the user with current  id and password exists or not 
    $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //3. check new password and confrom password match or not 
    $res=mysqli_query($conn,$sql);

    if($res==TRUE)
    {
        // cvheck whether is data is avalable or not 
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            // user exits and password can be changed
            //echo "user found.";
            // check whether the new password and confrom passsword matched or not
            if($new_password==$confirm_password)
            {
                // update the password 
                $sql2="UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id = $id
                ";
                // execute the query 
                $res2=mysqli_query($conn,$sql2);

                //check whether the query is executed or not 
                if($res2==TRUE)
                {
                    // display success massage 
                    // redirect to manage admin page with success massage 
                    $_SESSION['change-pwd']="<div class'success'>Password Changed Succesfully.</div>";
                    // redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    // display error massage
                    // redirect to manage admin page with error massage 
                    $_SESSION['change-pwd']="<div class'error'>Failed to Changed Password.</div>";
                    // redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                // redirect to manage admin page with error massage 
                $_SESSION['pwd-not-match']="<div class'error'>Password Did Not Match.</div>";
                // redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        else
        {
            // user does not exits set massage and redirect 
            $_SESSION['user-not-found']="<div class'error'>User Not Found.</div>";
            // redirect the user
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

    // 4. change password if all above is true
}


?>