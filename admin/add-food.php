<?php   include('partails/menu.php');      ?>

<div class="main-contant">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php  
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food ">
                    </td>
                </tr>


                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food."></textarea>
                    </td>
                </tr>


                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>


                <tr>
                    <td>Select Imge:</td>
                    <td>
                        <input type="file" name="image_name">
                    </td>
                </tr>


                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category_id" >

                            <?php
                                //create php code to display category from database



                                //1. create sql query to get all active category from database
                                //create php code to display category from database

                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                // execute the sql query
                                $res = mysqli_query($conn,$sql);

                                // counr rows to check whether we have category or not
                                $count = mysqli_num_rows($res);

                                // if the count greter than zero then we have category else we dont have category

                                if($count>0)
                                {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        //get the details of category
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }

                                }
                                else
                                {
                                    //we do not have category
                                    ?>
                                        <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>

                            

                            
                        </select>
                    </td>
                </tr>


                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>



                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


        <?php
        // check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo"clicked";

            //1. get the data from from form
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category_id=$_POST['category_id'];
            //check whether the radio button for featured and actiive are checked or not

            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else
            {
                $featured="No";//setting the defult value 
            }


            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="No";//setting the defult value 
            }

          

            //2.  upload the image if selected
            // check whether the select image button is clicked or not and upload the image only if the image is selected
            if(isset($_FILES['image_name']['name']))
            {
                // get the details of selected image 
                $image_name = $_FILES['image_name']['name'];

                // check whether the image is selected or not and upload image only if selected
                if($image_name!="")
                {
                    // image is selected 

                    //1. rename the image 
                    $temp = explode('.', $image_name);
                    $ext = end($temp); // Now end() receives a variable
                    

                    // create new name from here
                    $image_name = "Food_manu".rand(0000,9999).".".$ext;


                    //2. upload the image 

                    // get the src path and dest path

                    // source path is the current location of the image 

                    $src = $_FILES['image_name']['tmp_name'];

                    // destination path for the image are uploded

                    $dst = "../images/food/".$image_name;

                    // finaly uploded the food image 

                    $upload = move_uploaded_file($src,$dst);

                    // check whether image uploded or not 

                    if($upload==FALSE)
                    {
                        // falied to upload image 
                        // redirect to add food page with error masage
                        $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        //stop the process
                        die();
                    }
                }
                
            }
            else
            {
                $image_name="";// setting defalut value as blank
            }

            //3. insert into database

            //create sql qurey to save and add food 

            $sql2="INSERT INTO tbl_food SET
            title ='$title',
            description ='$description',
            price = $price,
            image_name = '$image_name',
            category_id=$category_id,
            featured='$featured',
            active='$active'


            ";

           // execute the query

           $res2=mysqli_query($conn,$sql2);

           // check whether the data insert or not 

            if($res2==TRUE)
            {
                // data inserted succesfully 
                $_SESSION['add']="<div class='success'>Food Added Succesfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                // falied to insert data 
                $_SESSION['add']=="<div class='error'>Failed to Added Food</div>";
                
                header('location:'.SITEURL.'admin/manage-food.php');
            }

            // redirect manage-food page with massage
        }
        
        
        ?>


    </div>
</div>


<?php   include('partails/footer.php');      ?>