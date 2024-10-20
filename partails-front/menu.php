<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <!-- link our css file -->
    <link rel="stylesheet" href="css/style.css">

    <!-- use icon remix icon cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
    <!-- nav bar sction start here  -->
    <section class="nav-bar">

        <div class="container">
            <div class="logo">
                <img src="images/logo.jpg" alt="Restaurant logo" class="img-responsive">
            </div>

            <div class="menu text-right">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>categories.php">Catagories</a></li>
                    <li><a href="<?php echo SITEURL; ?>food.php">Foods</a></li>
                    <li><a href="#">Contact us</a></li>
                </ul>
            </div>

            <div class="clearfix">

            </div>
        </div>

    </section>
    <!-- nav bar sction end here  -->