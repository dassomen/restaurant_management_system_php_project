<?php include('partails-front/menu.php'); ?>

<?php
    //check whether food id set or not
    if(isset($_GET['food_id']))
    {
        //get the id and detail of the selected food 
        $food_id = $_GET['food_id'];

        // get the details from selected food 
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //execute the query
        $res = mysqli_query($conn,$sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check whether data is available or not 
        if($count==1)
        {
            //we have data
            //get the data from database
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
            
        }
        else
        {
            //food not available
            //redirect to home page
            header('location:'.SITEURL);
        }

    }
    else
    {
        //redirect to home page
        header('location:'.SITEURL);
    }
?>



    <!-- food search sction start here  -->
    <section class="food-search text-center">

        <div class="container" style="background-color: white;">


            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method = "POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //check whether image name available or not 
                            if($image_name == "")
                            {
                                //image not available
                                echo "<div class='error' Image Not Available </div>>";
                            }
                            else
                            {
                                //image is available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve"  width="150px" height = "150px">
                                <?php
                            }
                        ?>
                        
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>

                        <input type="hidden" name = "food" value = "<?php echo $title; ?>">

                        <p class="food-price">RS.<?php echo $price; ?></p>

                        <input type="hidden" name = "price" value = "<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Your Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter Your Ph No." class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter Your Email id" class="input-responsive"
                        required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                        required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


            <?php
                //checked whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the detals from the form

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];
                    $total = $price * $quantity;
                    $order_date = date("Y-m-d h:i:sa");
                    $status = "ordered";  //ordered , on Delivery , Delivered , canceled
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];



                    // save the order in database
                    //create sql to save data
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        quantity = '$quantity',
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'

                    ";

                    // execute the query
                    //echo $sql2; die();

                    $res2 = mysqli_query($conn,$sql2);

                    // check whether query exequted succesfully or not 

                    if($res2 == TRUE)
                    {
                        //query executed and order saved
                        $_SESSION['order'] = "<div class='success text-center'>Food Orderd Succesfully...</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //failled to ave order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Orderd Food...</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>




        </div>
    </section>
    <!-- food search sction end here  -->







    <?php include('partails-front/footer.php'); ?>