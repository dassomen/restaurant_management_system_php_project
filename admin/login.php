<?php  include('../config/constants.php'); ?>
<html>
    <thead>
        <title>Login - Resturant-Manegement-System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </thead>
    <body style="background-color: blueviolet ;">
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }


                if(isset($_SESSION['no-login-massage']))
                {
                    echo $_SESSION['no-login-massage'];
                    unset($_SESSION['no-login-massage']);
                }
            ?>
            <br><br>
            <!-- login form start here -->
             <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter User Name"><br><br>


                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"> <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
             </form>
            <!-- login form end here -->

            <p class="text-center">Created By <a href="#">Somen Das</a></p>
        </div>

    </body>
  
</html>

<?php
// check whether the submit button is clicked or not 
if(isset($_POST['submit']))
{
    // process for login

    //1. get the data from login from 
     $user_name=$_POST['username'];
     $password=md5($_POST['password']);

     //.sql to check whwther the user with username and password exists or not 
     $sql="SELECT * FROM tbl_admin WHERE username='$user_name' AND password='$password'";

     //3. execute the query 
     $res= mysqli_query($conn,$sql);

     //4.count rows to check whether the user exits or not 
     $count=mysqli_num_rows($res);

     if($count==1)
     {
        // user available and logi success
        $_SESSION['login']="<div class='success'>Login Successfull..</div>";
        $_SESSION['user'] = $user_name;// to check whwther the user log in or not and log out with unset it 
        // redirect to home page/dashbord
        header('location:'.SITEURL.'admin/');
     }
     else
     {
        // user not available  login failled
        $_SESSION['login']="<div class='error text-center'>Username and Password did not match</div>";
        // redirect to home page/dashbord
        header('location:'.SITEURL.'admin/login.php');
     }
}

?>