<?php include('partails/menu.php');  ?>

<div class="main-contant">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))//cheking whether the seasion is set or not
            {
                echo $_SESSION['add']; // display the session massage if set
                unset($_SESSION['add']);//remove session massage
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text"name="full_name" placeholder="Enter Your Name"></td>
                   
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text"name="username" placeholder=" Your Username"></td>
                   
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password"name="password" placeholder=" Your Password"></td>
                   
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>
    </div>
</div>


<?php include('partails/footer.php');  ?>



<?php
 //process the value from and save it database 

 //check whether the submit button is click or not 
 if(isset($_POST['submit']))
 {
    //button clicked
    //echo "Button clicked";

    //1. get the data form from

     $full_name=$_POST['full_name'];
     $username=$_POST['username'];
     $password=md5($_POST['password']);//password incription with MD5


     // 2. SQL Query to save the data in database
     $sql="INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
     ";

    
    //3. executing query and saving data in database
     $res= mysqli_query($conn , $sql) or die(mysqli_error());

     //4. check whether the (query is exucuted) data is inseted or not and display apropiate massage
    if($res == TRUE)
    {
        // data inserted
        //echo "data inserted";
        //create a session variable to display the massage 
        $_SESSION['add'] = "<div class='success'>Admin Added Succesfully</div>";
        //redirect page to manage admin 
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // fall to insert data
        //echo"data failled to insert";
          //create a session variable to display the massage 
          $_SESSION['add'] = "<div class='error'>Falled to Add Admin</div>";
          //redirect page to add admin 
          header("location:".SITEURL.'admin/add-admin.php');
    }


 }



?>