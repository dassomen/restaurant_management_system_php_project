<?php 
   ob_start(); // Start output buffering to prevent "headers already sent" errors
   include('partails/menu.php'); 
?>

<?php
    // check whether id is set or not 
    if(isset($_GET['id']))
    {
        // get all the details
        $id = $_GET['id'];

        // sql query to get the selected food 
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        // get the value based on query executed 
        $row2 = mysqli_fetch_assoc($res2);

        // get the individual values of selected food 
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        //redirect to manage food page 
        header('location:'.SITEURL.'admin/manage-food.php');
        exit;
    }
?> 

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl_30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image == "")
                            {
                                echo"<div class='error'>Image Not Available</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                                <?php
                            }
                         ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image_name">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category_id">
                            <?php 
                                // query to get active category
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count > 0)
                                {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        ?>
                                            <option <?php if($current_category == $category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "<option value='0'>Category Not Available</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
        if(isset($_POST['submit']))
        {
            // Get all the details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category_id = $_POST['category_id'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Handle file upload if new image is selected
            if(isset($_FILES['image_name']['name']) && $_FILES['image_name']['name'] != "")
            {
                // File is selected
                $image_name = $_FILES['image_name']['name'];
                
                // Rename the image
                $temp = explode('.', $image_name);
                $ext = end($temp); // Get the file extension
                $image_name = 'food-name'.rand(0000,9999).'.'.$ext; // Rename the image
                
                // Source and destination paths
                $src_path = $_FILES['image_name']['tmp_name'];
                $dest_path = "../images/food/".$image_name;
                
                // Upload the image
                $upload = move_uploaded_file($src_path, $dest_path);
                
                if($upload == false)
                {
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    exit;
                }

                if($current_image != "")
                {
                    // Remove the current image
                    $remove_path = "../images/food/".$current_image;
                    $remove = unlink($remove_path);

                    if($remove == false)
                    {
                        $_SESSION['remove_failed'] = "<div class='error'>Failed to Remove Current Image</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        exit;
                    }
                }
            }
            else
            {
                // No new image selected, use the current image
                $image_name = $current_image;
            }

            // Update the food in the database
            $sql3 = "UPDATE tbl_food SET 
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id='$category_id',
                featured='$featured',
                active='$active'
                WHERE id=$id
            ";
            $res3 = mysqli_query($conn, $sql3);

            if($res3 == true)
            {
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='error'>Failed to Update Food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>

<?php 
   include('partails/footer.php'); 
   ob_end_flush(); // End output buffering and flush the output
?>
