<?php include('partails-front/menu.php'); ?>

<?php
    //checked whether id is passed or not 
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $category_id = $_GET['category_id'];
        //get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        // execute the query
        $res = mysqli_query($conn,$sql);

        // get the value from database

        $row = mysqli_fetch_assoc($res);
        //get the tittle

        $category_title = $row['title'];
    }
    else
    {
        // category not passed
        //redirect to home page
        header('location:'.SITEURL);
    }
?>



    <!-- food search sction start here  -->
    <section class="food-search text-center">

        <div class="container">


            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>




        </div>
    </section>
    <!-- food search sction end here  -->




    <!-- food manu sction start here  -->
    <section class="food-manu">

        <div class="container">
            <h2 class="text-center">Foods Manu</h2>

            <?php
                // create sql query to get food based on selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                // execute the query
                $res2 = mysqli_query($conn,$sql2);

                //count the rows
                $count2 = mysqli_num_rows($res2);

                // check whether food available or not 

                if($count2>0)
                {
                    //food is available
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                            <div class="food-manu-box">
                                <div class="food-manu-img">
                                    <?php
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
                    //food is not available
                    echo "<div class='error'>Food Not Available</div>";
                }
            ?>

            

            <div class="clearfix"></div>

        </div>
    </section>
    <!-- food manu sction end here  -->



    <?php include('partails-front/footer.php'); ?>






   