<?php include('partails-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="catagories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php  

                // display all the category that are active
                // SQL Query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";

                // execute the query
                $res = mysqli_query($conn,$sql);
                // count rows to check whether categories is available or not 
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    // categori available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // get the value like id, title, image name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                              <a href="<?php echo SITEURL; ?>caregories-food.php?category_id=<?php echo $id; ?>">
                                    <div class="box-3 float-container">
                                        <?php
                                        if($image_name == "")
                                        {
                                            // image not available
                                            echo "<div class='error'>Image Not Found.</div>";
                                        }
                                        else
                                        {
                                            //image available 
                                            ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                        ?>
                                       
                                        

                                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                    </div>
                                </a>
                        <?php
                    }
                }
                else
                {
                    // categori not available
                    echo "<div class='error'>Category Not Found.</div>";
                }
            
            ?>

          


            
          



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partails-front/footer.php'); ?>


   