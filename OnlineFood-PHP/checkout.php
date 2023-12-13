<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Singapore');


function function_alert() { 
      

//    echo "<script>alert('Thank you. Your Order has been placed!');</script>"; 
    echo "<script>window.location.replace('Final_deal.php');</script>"; 
} 

function generateOrderNumber() {
    // Get the current date and time
    $dateTime = date('YmdHis');

    // Generate a unique identifier
    $uniqueId = uniqid();

    // Concatenate date/time and unique identifier
    $orderNumber = 'ORD' . $dateTime . $uniqueId;

    // Ensure the order number has a length of 20 characters
    $orderNumber = substr($orderNumber, 0, 20);

    return $orderNumber;
}

if(empty($_SESSION["user_id"])){
	header('location:login.php');
}
else{

    $orderNumber = generateOrderNumber();

    $_SESSION["order_id"] = $orderNumber;
										  
    foreach ($_SESSION["cart_item"] as $item){
		$item_total += ($item["price"]*$item["quantity"]);
		if($_POST['submit']){
            $SQL="insert into order_items(uo_id,title,quantity,price) values('".$orderNumber."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";
			mysqli_query($db,$SQL);
			}
	}
    if($_POST['submit']){
    $SQL1="insert into user_orders(uo_id, u_id, price) values('".$orderNumber."','".$_SESSION["user_id"]."','".$item_total."')";
    mysqli_query($db,$SQL1);
    function_alert();	
    }
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Checkout</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
    .credit-card-fields {
      display: none;
    }
  </style>
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
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">

                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose
                                Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a>
                        </li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Order and
                                Pay</a></li>
                    </ul>
                </div>
            </div>

            <div class="container">

                <span style="color:green;">
                    <?php echo $success; ?>
                </span>

            </div>




            <div class="container m-t-30">
                <form action="" method="post">
                    <div class="widget clearfix">

                        <div class="widget-body">
                            <form method="post" action="#">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="cart-totals margin-b-20">
                                            <div class="cart-totals-title">
                                                <h4>Cart Summary</h4>
                                            </div>
                                            <div class="cart-totals-fields">

                                                <table class="table">
                                                    <tbody>



                                                        <tr>
                                                            <td>Cart Subtotal</td>
                                                            <td> <?php echo "$".$item_total; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Delivery Option</td>
                                                            <td>
                                                            <select id="delivery-options" onchange="updateDeliveryCharge()">
                                                                <option value="Delivery">Delivery</option>
                                                                <option value="Self Pick-Up">Self Pick-Up</option>
                                                            </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Delivery Charges</td>
                                                            <td><p id="delivery-charge">Free</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-color"><strong>Total</strong></td>
                                                            <td class="text-color"><strong>
                                                                    <?php echo "$".$item_total; ?></strong></td>
                                                        </tr>
                                                    </tbody>




                                                </table>
                                            </div>
                                        </div>
                                        <div class="payment-option">
                                            <ul class=" list-unstyled">
                                                <li>
                                                    <label class="custom-control custom-radio  m-b-20">
                                                        <input name="mod" id="radioStacked1" checked value="COD" onchange="toggleCreditCardFields()"
                                                            type="radio" class="custom-control-input"> <span
                                                            class="custom-control-indicator"></span> <span
                                                            class="custom-control-description">Cash</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="custom-control custom-radio  m-b-10">
                                                        <input name="mod" type="radio" value="card" onchange="toggleCreditCardFields()"
                                                            class="custom-control-input"> <span
                                                            class="custom-control-indicator"></span> <span
                                                            class="custom-control-description">Card Payment<img
                                                                src="images/paypal.jpg" alt="" width="90"></span>
                                                    </label>
                                                </li>
                                                <div class="credit-card-fields">
                                                    <label for="cardNumber">Card Number:</label>
                                                    <input type="text" id="cardNumber" name="cardNumber"
                                                        placeholder="Enter card number">

                                                    <label for="expiryDate">Expiry Date:</label>
                                                    <input type="text" id="expiryDate" name="expiryDate"
                                                        placeholder="MM/YY">

                                                    <label for="cvv">CVV:</label>
                                                    <input type="text" id="cvv" name="cvv" placeholder="Enter CVV">
                                                </div>
                                            </ul>
                                            <p class="text-xs-center"> <input type="submit"
                                                    onclick="return confirm('Do you want to confirm the order?');"
                                                    name="submit" class="btn btn-success btn-block" value="Order Now">
                                            </p>
                                        </div>
                            </form>
                        </div>
                    </div>

            </div>
        </div>
        </form>
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
    <script>
        function toggleCreditCardFields() {
            var creditCardFields = document.querySelector(".credit-card-fields");
            var creditCardOption = document.querySelector('input[name="mod"][value="card"]');

            if (creditCardOption.checked) {
            creditCardFields.style.display = "block";
            } else {
            creditCardFields.style.display = "none";
            }
        }
        function updateDeliveryCharge() {
            var deliveryOption = document.getElementById("delivery-options").value;
            var chargeText = document.getElementById("delivery-charge");

            if (deliveryOption === "Delivery") {
                chargeText.innerText = "Free";
            } else if (deliveryOption === "Self Pick-Up") {
                chargeText.innerText = "None";
            }
        }
            </script>
</body>

</html>

<?php
}
?>