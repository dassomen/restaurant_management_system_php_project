<?php include('partails-front/menu.php'); ?>



    <!-- food search sction start here  -->
    <section class="food-search text-center">

        <div class="container">

            <?php
            //get the search keyword
            $search = $_POST['search'];
            ?>


            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>




        </div>
    </section>
    <!-- food search sction end here  -->




    <!-- food manu sction start here  -->
    <section class="food-manu">

        <div class="container">
            <h2 class="text-center">Foods Manu</h2>

            <?php
                
                //SQL Query to foods based on search keyword
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";

                // execute the query
                $res = mysqli_query($conn,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether food available or not

                if($count>0)
                {
                    //food available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-manu-box">
                            <div class="food-manu-img">
                                <?php
                                //check whether image is available or not 
                                if($image_name == "")
                                {
                                    //image not available
                                   echo "<div class='error'>Image Not Available</div>";
                                }
                                else
                                {
                                    // image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="chicken Hawain pizza" class="img-responsive img-carved">
                                    <?php
                                }
                                ?>
                                
                            </div>
                            <div class="food-manu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">RS. <?php echo $price; ?></p>
                                <p class="food-detail"><?php echo $description; ?></p>
                                <br>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                            <!-- <div class="clearfix"></div> -->
                        </div>
                        <?php
                    }
                }
                else
                {
                    //food not available
                    echo"<div class='error'>Food Not Found</div>";
                }
            ?>

            

            <div class="clearfix"></div>

        </div>
    </section>
    <!-- food manu sction end here  -->






    <?php include('partails-front/footer.php'); ?>