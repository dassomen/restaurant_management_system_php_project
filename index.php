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

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset ($_SESSION['order']);
        }
    ?>


    <!-- catagories sction start here  -->
    <section class="catagories">

        <div class="container">

            <h2 class="text-center">Explore Foods</h2>

            <?php
            
                // creare sql query to display catagories to database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featarud='Yes' LIMIT 3";
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
                                // check whether image available or nor
                                if($image_name == "")
                                {
                                    // display massage
                                    echo"<div class='error'>Image Not Available.</div>";
                                }
                                else
                                {
                                    // image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="pizza" class="img-responsive img-curve">
                                    <?php
                                }
                                ?>
                                
                                <h3 class="float-text"><?php echo $title; ?></h3>
                            </div>
                         </a>

                        <?php

                    }
                }
                else
                {
                    //categories not available
                    echo "<div class='error'>Category Not Added.</div>";
                }
            
            ?>

           


           


            <div class="clearfix"></div>

        </div>
    </section>
    <!-- catagories sction end here  -->


    <!-- food manu sction start here  -->
    <section class="food-manu">

        <div class="container">
            <h2 class="text-center">Foods Manu</h2>

            <?php
            //geting food from database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            // execute the query
            $res2 = mysqli_query($conn,$sql2);
            // count rows
            $count2 = mysqli_num_rows($res2);
            //check whether food available or not 
            if($count2>0)
            {
                //food available
                while($row = mysqli_fetch_assoc($res2))
                {
                    //get all the values
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
                                    echo"<div class='error'>Image Not Available</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="chicken Hawain pizza" class="img-responsive img-carved">
                                    <?php
                                }
                            ?>
                            
                        </div>
                        <div class="food-manu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">RS.<?php echo $price; ?></p>
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
                echo "<div class='error'>Food Not Available</div>";
            }
            ?>

            



            

            <div class="clearfix"></div>

        </div>
    </section>
    <!-- food manu sction end here  -->



    <?php include('partails-front/footer.php'); ?>
    