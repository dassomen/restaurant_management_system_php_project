<?php include('partails-front/menu.php'); ?>



    <!-- food search sction start here  -->
    <section class="food-search text-center">

        <div class="container">


            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="search for food...">
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>




        </div>
    </section>
    <!-- food search sction end here  -->




    <!-- food manu sction start here  -->
    <section class="food-manu">

        <div class="container">
            <h2 class="text-center">Foods Manu</h2>

            <?php  
            //display food that are active
            $sql = "SELECT * FROM tbl_food WHERE active='Yes' ";
            //execute the query
            $res = mysqli_query($conn,$sql);
            //count rows
            $count = mysqli_num_rows($res);
            //check whether the food available or not 
            if($count>0)
            {
                //food Available
                while($row = mysqli_fetch_assoc($res))
                {
                    //get the values
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
                                    //image are not available
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else
                                {
                                    //image are available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="chicken Hawain pizza" class="img-responsive img-carved">
                                    <?php
                                }
                                ?>
                                
                            </div>
                            <div class="food-manu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">RS.<?php echo $price; ?> </p>
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
                //food not avaiklable
                echo"<div class='error'>Food Not Found</div>";
            }
            ?>

           



           

            <div class="clearfix"></div>

        </div>
    </section>
    <!-- food manu sction end here  -->






    <?php include('partails-front/footer.php'); ?>