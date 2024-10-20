<?php   include('partails/menu.php');      ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>
        <br><br>

        <!-- add category from srart here -->
         <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image_name">
                    </td>
                </tr>


                <tr>
                    <td>Featarud: </td>
                    <td>
                        <input type="radio" name="featarud" value="Yes">Yes
                        <input type="radio" name="featarud" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active"value="Yes">Yes
                        <input type="radio" name="active"value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category"class="btn-secondary">
                    </td>
                </tr>
            </table>
         </form>
        <!-- add category from end here -->

        <?php
            // check whether the submit butten is clicked or not
            if(isset($_POST['submit']))
            {
                //echo"Clicked";

                // get the value from category form
                $title=$_POST['title'];

                // for eadio input type, we need to check whether the button is selected or not
                if(isset($_POST['featarud']))
                {
                    // get the value from form 
                    $featarud=$_POST['featarud'];
                }
                else
                {
                    // set the value from form 
                    $featarud="No";
                }


                if(isset($_POST['active']))
                {
                    $active=$_POST['active'];
                }
                else
                {
                    $active="No";
                }
                // check whether the image is selected or not and set the value for image name accoridingly
                // print_r($_FILES['image']);

                //die(); // to brake the code here

                if(isset($_FILES['image_name']['name']))
                {
                    // uplode the image 
                    // the upload image we need image name, source path , and destination path 
                    $image_name =$_FILES['image_name']['name'];

                    // upload the image if only image is selected
                    if($image_name != "")
                    {

                    

                        // auto rename our image 
                        // get the extention of our image (jpg,png,gif,etc)
                        $ext = end(explode('.',$image_name));

                        // rename the image 
                        $image_name = "Food_Category".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image_name']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        // finnaly uplode the image 
                        $upload = move_uploaded_file($source_path,$destination_path);

                        // check whether the image is uploded or not 
                        // and if the image is not uploded then we will stop the prosess and redirect with error page
                        if($upload==FALSE)
                        {
                            // set massage 
                            $_SESSION['upload']="Failed to Upload Image";
                            // redirect to add category page
                            header('location:'.SITEURL.'admin/add-category.php');
                            // stop process
                            die();
                        }
                    }
                }
                else
                {
                    // dont upload the image and set the image_name value as a blank
                    $image_name ="";
                }

                // 2. create SQL Query to insert category to database
                $sql="INSERT INTO tbl_category SET
                     	title ='$title',
                        image_name ='$image_name',
                        featarud  ='$featarud',
                        active ='$active'
                ";

                //3. execute the query and save the data in database
                $res=mysqli_query($conn,$sql);
                // 4. check whether the query executed or not and data added database or not
                if($res==TRUE)
                {
                    // query executrd and category added
                    $_SESSION['add']="<div class='success'>Category Added Succesfully...</div>";
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // falled to add category
                    $_SESSION['add']="<div class='error'>Failed to add category...</div>";
                    // redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }


            }
        ?>

    </div>
</div>


<?php   include('partails/footer.php');      ?>