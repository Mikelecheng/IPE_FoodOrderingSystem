<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION['user_id']))  
{
	header('location:login.php');
}
else
{
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>My Orders</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css" rel="stylesheet">
    .indent-small {
        margin-left: 5px;
    }

    .form-group.internal {
        margin-bottom: 0;
    }

    .dialog-panel {
        margin: 10px;
    }

    .datepicker-dropdown {
        z-index: 200 !important;
    }

    .panel-body {
        background: #e5e5e5;
        /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* FF3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
        /* Chrome,Safari4+ */
        background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Opera 12+ */
        background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* IE10+ */
        background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
        font: 600 15px "Open Sans", Arial, sans-serif;
    }

    label.control-label {
        font-weight: 600;
        color: #777;
    }


    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {}


    @charset "UTF-8";
    @import url("https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");

    .pcs:after {
        content: " pcs";
    }

    .cur:before {
        content: "$";
    }

    .per:after {
        content: "%";
    }

    * {
        box-sizing: border-box;
    }

    body {
        padding: 0.2em 2em;
    }

    table {
        width: 100%;
    }

    table th {
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    table th,
    table td {
        padding: 0.4em;
    }

    table.fold-table>tbody>tr.view td,
    table.fold-table>tbody>tr.view th {
        cursor: pointer;
    }

    table.fold-table>tbody>tr.view td:first-child,
    table.fold-table>tbody>tr.view th:first-child {
        position: relative;
        padding-left: 20px;
    }

    table.fold-table>tbody>tr.view td:first-child:before,
    table.fold-table>tbody>tr.view th:first-child:before {
        position: absolute;
        top: 50%;
        left: 5px;
        width: 9px;
        height: 16px;
        margin-top: -8px;
        font: 16px fontawesome;
        color: #999;
        content: "";
        transition: all 0.3s ease;
    }

    table.fold-table>tbody>tr.view:nth-child(4n-1) {
        background: #eee;
    }

    table.fold-table>tbody>tr.view:hover {
        background: #000;
    }

    table.fold-table>tbody>tr.view.open {
        background: tomato;
        color: white;
    }

    table.fold-table>tbody>tr.view.open td:first-child:before,
    table.fold-table>tbody>tr.view.open th:first-child:before {
        transform: rotate(-180deg);
        color: #333;
    }

    table.fold-table>tbody>tr.fold {
        display: none;
    }

    table.fold-table>tbody>tr.fold.open {
        display: table-row;
    }

    .fold-content {
        padding: 0.5em;
    }

    .fold-content h3 {
        margin-top: 0;
    }

    .fold-content>table {
        border: 2px solid #ccc;
    }

    .fold-content>table>tbody tr:nth-child(even) {
        background: #eee;
    }
    </style>

</head>

<body>


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



        <div class="inner-page-hero bg-image" data-image-src="images/img/pimg.jpg">
            <div class="container"> </div>

        </div>
        <div class="result-show">
            <div class="container">
                <div class="row">


                </div>
            </div>
        </div>

        <section class="restaurants-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                    </div>
                    <div class="col-xs-12">
                        <div class="bg-gray">
                            <div class="row">

                                <table class="fold-table">
                                    <thead style="background: #404040; color:white;">
                                        <tr>

                                            <th>Order Number</th>
                                            <th>Order Price</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php 
				
						$query_res= mysqli_query($db,"select * from user_orders where u_id='".$_SESSION['user_id']."'");
												if(!mysqli_num_rows($query_res) > 0 )
														{
															echo '<td colspan="6"><center>You have No orders Placed yet. </center></td>';
														}
													else
														{			      
										  
										  while($row=mysqli_fetch_array($query_res))
										  {
						
							?>
                                        <tr class="view">
                                            <td data-column="Item"> <?php echo $row['uo_id']; ?></td>
                                            <td data-column="Price">$<?php echo $row['price']; ?></td>

                                            <td data-column="status">
                                                <?php 
																			$status=$row['status'];
																			if($status=="" or $status=="NULL")
																			{
																			?>
                                                <button type="button" class="btn btn-info"><span class="fa fa-bars"
                                                        aria-hidden="true"></span> Dispatch</button>
                                                <?php 
																			  }
																			   if($status=="in process")
																			 { ?>
                                                <button type="button" class="btn btn-warning"><span
                                                        class="fa fa-cog fa-spin" aria-hidden="true"></span> In Progress</button>
                                                <?php
																				}
																			if($status=="closed")
																				{
																			?>
                                                <button type="button" class="btn btn-success"><span
                                                        class="fa fa-check-circle" aria-hidden="true"></span>
                                                    Delivered</button>
                                                <?php 
																			} 
																			?>
                                                <?php
																			if($status=="rejected")
																				{
																			?>
                                                <button type="button" class="btn btn-danger"> <i
                                                        class="fa fa-close"></i> Cancelled</button>
                                                <?php 
																			} 
																			?>
                                                <?php
																			if($status=="ready")
																				{
																			?>
                                                <button type="button" class="btn btn-warning"> <i
                                                        class="fa fa-cog fa-spin"></i> Ready</button>
                                                <?php 
																			} 
																			?>
                                                <?php
																			if($status=="completed")
																				{
																			?>
                                                <button type="button" class="btn btn-success"> <i
                                                        class="fa fa-check-circle"></i> Completed</button>
                                                <?php 
																			}
																			?>


                                            </td>
                                            <td data-column="Date"> <?php echo $row['date']; ?></td>
                                            <td data-column="Action"> <a
                                                    href="delete_orders.php?order_del=<?php echo $row['o_id'];?>"
                                                    onclick="return confirm('Are you sure you want to cancel your order?');"
                                                    class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i
                                                        class="fa fa-trash-o" style="font-size:16px"></i></a>
                                            </td>

                                        </tr>
                                        <tr class="fold">
                                            <td colspan="7">
                                                <div class="fold-content">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>Item</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
															//print $row['uo_id'];
															$query_res1= mysqli_query($db,"select * from order_items where uo_id='".$row['uo_id']."'");
															while($row1=mysqli_fetch_array($query_res1)){
															//	print $row1['title'];
														?>
                                                            <tr>
                                                                <td><?php echo $row1['title']; ?></td>
                                                                <td><?php echo $row1['quantity']; ?></td>
                                                                <td>$<?php echo $row1['price']; ?></td>
                                                                <?php }?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php }} ?>




                                    </tbody>
                                </table>



                            </div>

                        </div>



                    </div>



                </div>
            </div>
    </div>
    </section>


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
<?php
}
?>

<script>
$(function() {
    $(".fold-table tr.view").on("click", function() {
        $(this).toggleClass("open").next(".fold").toggleClass("open");
    });
});
</script>