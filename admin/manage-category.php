<?php include('partails/menu.php');  ?>

<div class="main-contant">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }


            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }


            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }


            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }


            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-removed']))
            {
                echo $_SESSION['failed-removed'];
                unset($_SESSION['failed-removed']);
            }
        
        ?>
        <br><br>

                <!-- button to add admin -->
                 <a href="<?php echo SITEURL ?>admin/add-category.php" class="btn-primary">Add Category</a>
                 <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        // query to get all data in database
                        $sql="SELECT * FROM tbl_category ";
                        // exequte query
                        $res=mysqli_query($conn,$sql);

                        // count rows
                        $count = mysqli_num_rows($res);

                        // create serial number variable and assign value as 1 
                        $sn=1;
                        // check we have  the data in database or not
                        if($count>0) 
                        {
                            // we have data in database
                            // get the data and display
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title  = $row['title'];
                                $image_name = $row['image_name'];
                                $featarud  = $row['featarud'];
                                $active   = $row['active'];

                                ?>

                                <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td><?php echo $title; ?></td>

                                    <td>
                                        <?php 
                                            //check whether the image available or not 
                                            if($image_name!="")
                                            {
                                                // display the image 
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" width="100px" >

                                                <?php
                                            }
                                            else
                                            {
                                                // display the massage 
                                                echo"<div class='error'>Image Not Added</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $featarud; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name; ?>" class="btn-denger">Delete Category</a>
                                
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            // we have no data in database 
                            // we will display the massage inside table 
                            ?>

                            <tr>
                                <td colspan="6"><div class="error">No Category Added</div></td>
                            </tr>

                            <?php
                        }
                    
                    ?>

                    

                    


                </table>


    </div>
    
</div>


<?php include('partails/footer.php');  ?>
