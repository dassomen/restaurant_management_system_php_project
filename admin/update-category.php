<?php   include('partails/menu.php');      ?>

<div class="main-contant">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php  
            // check whether the id is set or not 
            if(isset($_GET['id']))
            {
                // get the id and all other details 
                //echo "geting the all data";
                $id=$_GET['id'];
                // create sql query to get all other deatils
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                // execute the query

                $res = mysqli_query($conn,$sql);

                // count the rows to check the id is valid or not 

                $count = mysqli_num_rows($res);

                if($count==1)
                {
                   // get the all data
                   $row = mysqli_fetch_assoc($res);
                   $title = $row['title'];
                   $current_image = $row['image_name'];
                   $featarud  = $row['featarud'];
                   $active  = $row['active'];
                }
                else
                {
                     // redirect to manage category with seasion massage
                     $_SESSION['no-category-found']="<div class='error'>Category Not Found</div>";
                     header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                // redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                // display the image
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                // display massage
                                echo"<div class='error'>Image Not added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image_name">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featarud =="Yes"){echo "checked";} ?> type="radio" name="featarud" value="Yes"> Yes

                        <input  <?php if($featarud =="No"){echo "checked";} ?> type="radio" name="featarud" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No" >No
                    </td>
                </tr>

                <tr>
                    <td>
                    <input type="hidden" name = "current_image" value ="<?php echo $current_image; ?>">  
                    <input type="hidden" name ="id" value="<?php echo $id;  ?>">  
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>



        <?php
            if(isset($_POST['submit']))
            {
                //echo"Clicked";

                // get the all value from our form 
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featarud  = $_POST['featarud'];
                $active =$_POST['active'];


                //2. updating new image if selected
                // check whwther the image is selected or not 
                if(isset($_FILES['image_name']['name']))
                {
                    // get the Image Details
                    $image_name=$_FILES['image_name']['name'];

                    // check whether image is avilable or not
                    if($image_name!="")
                    {
                        // image available 
                        //A. upload the new image 

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
                            header('location:'.SITEURL.'admin/manage-category.php');
                            // stop process
                            die();
                        }

                        //B. remove the current image  if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);

                            // check whether the image are removed or not 
                            // if failed to removed then display masage and stop the process
                            if($remove==FALSE)
                            {
                                // failed to removed the image 
                                $_SESSION['failed-removed']="<div class='error'>Failed to removed current image</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();// stop the process
                            }
                        }
                        
                    }
                    else
                    {
                        $image_name=$current_image;
                    }
                }
                else
                {
                    $image_name=$current_image;
                }



                //3. update the database
                $sql2="UPDATE tbl_category SET 
                title='$title',
                image_name='$image_name',
                featarud ='$featarud',
                active='$active'
                WHERE id=$id
                ";

                // execute the query 
                $res2 = mysqli_query($conn,$sql2);


                // 4. redirect to manage category with massahge 
                // check whether executed or not 
                if($res2==TRUE)
                {
                    // category updated
                    $_SESSION['update']="<div class='success'>Category Updated Successfully...</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // falled to update category
                    $_SESSION['update']="<div class='error'>Failed to Update Category...</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }



            }
        
        ?>
    </div>
</div>

<?php   include('partails/footer.php');      ?>