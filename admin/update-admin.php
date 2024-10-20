<?php include('partails/menu.php')  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
            //1. get the ID of selected admin
            $id=$_GET['id'];

            //2. create SQL query to get the details 
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            // execute the query 
            $res=mysqli_query($conn,$sql);

            // check whwther the query is executed or not 
            if($res==TRUE)
            {
                // check whwther the data is avalable or not
                $count=mysqli_num_rows($res);
                //check whwther we have admin data or not 
                if($count==1)
                {
                    //get the deatials 
                    //echo "Admin Available ";
                    $row=mysqli_fetch_assoc($res);

                    $full_name=$row['full_name'];
                    $username=$row['username'];


                }
                else
                {
                    // redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>">
                    </td>
                </tr>


                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php 
 //check whether the submit button is clicked or not
 if(isset($_POST['submit']))
{
    //echo "Button clicked";
    // get all the values from the form to update
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    // create sql query to update admin

    $sql="UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username' 
    WHERE id='$id'
    ";

    // execute the query 
    $res=mysqli_query($conn,$sql);

    // check executed the query seccesfully execute or not 
    if($res==TRUE)
    {
        // query executed and admin updated
        $_SESSION['update']="<div class='success'>Admin Updated Succesfully. </div>";
        // redirect to manage admin page 
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // failed to update admin 
        $_SESSION['update']="<div class='error'>Failed to Delete Admin. </div>";
        // redirect to manage admin page 
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
?>



<?php include('partails/footer.php')  ?>