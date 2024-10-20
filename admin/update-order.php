<?php include('partails/menu.php'); ?>


<div class="main-contant">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
            //check whether is is set or not
            if(isset($_GET['id']))
            {
                //get the order details
                $id = $_GET['id'];

                // get all the details based on this id
                //sql query to get the order details

                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                //execute the wuery
                $res = mysqli_query($conn,$sql);
                //count rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //detail available 
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    
                   
                }
                else
                {
                    //detail not available
                    // redirect to manage order
                    header('location:'.SITEURL.'admin/manage-order.php');
                }


            }
            else
            {
                //redirect manage order page 
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>


        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name:</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><b>RS.<?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Quantity:</td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo $quantity; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option <?php if($status == 'ordered'){echo "selected";} ?> value="ordered">Ordered</option>
                            <option <?php if($status == 'On_Delivery'){echo "selected";} ?> value="On_Delivery">On Delivery</option>
                            <option <?php if($status == 'Delivered'){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status == 'Cancelled'){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name = "id" value = "<?php echo $id; ?>">
                        <input type="hidden" name = "price" value = "<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


        <?php
        
        //checkek whether the update button is clicked or not 

        if(isset($_POST['submit']))
        {
            //echo "clicked";

            //get all the values from the form 
            $id = $_POST['id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $total = $price * $quantity;
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            //update the value

            $sql2 = "UPDATE tbl_order SET 
                quantity = $quantity,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id=$id
            ";

            //execute the query

            $res2 = mysqli_query($conn,$sql2);

            // check whether update or not 

            if($res2 == TRUE)
            {
                //updated
                $_SESSION['update']="<div class='success'>Order updated succesfully</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            else
            {
                //failed to updated
                $_SESSION['update']="<div class='error'>Failed to update order</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }


            //and redirect to manage order page with massage
        }
        
        ?>


    </div>
</div>




<?php include('partails/footer.php'); ?>