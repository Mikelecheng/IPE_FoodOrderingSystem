<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

date_default_timezone_set('Asia/Singapore');
if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Confirm</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <div class="site-wrapper">
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                        data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/icn.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span
                                        class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span
                                        class="sr-only"></span></a> </li>

                            <?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
							}

						?>

                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container">

            <span style="color:green;">
            </span>

        </div>




        <div class="container m-t-30">
            <div class="widget clearfix">

                <div class="widget-body">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="cart-totals margin-b-20">
                                <div class="cart-totals-title">
                                    <h4>Thank u</h4>
                                    <h4></h4>
                                    <h4>Order Confirmed!</h4>
                                    <h4>Order Number: <span><?php echo $_SESSION["order_id"];?></span></h4>
                                    <h4>Order Date: <span><?php echo date('Y-m-d H:i:s');?></span></h4>
                                </div>
                                <div class="cart-totals-fields">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="text-color"><strong>Item Name</strong></td>
                                                <td class="text-color"><strong>Price</strong></td>
                                                <td class="text-color"><strong>Quantity</strong></td>
                                            </tr>
                                            <?php 
                                          foreach ($_SESSION["cart_item"] as $item){
                                            $item_total += ($item["price"]*$item["quantity"]);  
                                          
                                        ?>

                                            <tr>
                                                <td> <?php echo $item["title"]; ?></td>
                                                <td> <?php echo $item["price"]; ?></td>
                                                <td> <?php echo $item["quantity"]; ?></td>
                                            </tr>
                                            <?php
                                          } ?>
                                            <tr>
                                                <td class="text-color"><strong>Total</strong></td>
                                                <td class="text-color"><strong>
                                                        <?php echo "$".$item_total; ?></strong></td>
                                                <td class="text-color"><strong></strong></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <?php
                                        unset($_SESSION["cart_item"]);
                                        unset($item["title"]);
                                        unset($item["quantity"]);
                                        unset($item["price"]);
                                        unset($_SESSION["order_id"]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="row bottom-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>Payment Options</h5>
                            <ul>
                                <li>
                                    <a href="#"> <img src="images/nets.png" alt="Nets"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/visa.png" alt="Visa"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/apple-pay.png" alt="Apple"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/google-pay.png" alt="Google"> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>Address</h5>
                            <p>8 Wilkie Rd, #02-01 Wilkie Edge, Singapore</p>
                            <h5>Phone: +65 67331877</a></h5>
                        </div>
                        <div class="col-xs-12 col-sm-5 additional-info color-gray">
                            <h5>Addition informations</h5>
                            <p>Join thousands of other restaurants who benefit from having partnered with us.</p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </footer>
    </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>