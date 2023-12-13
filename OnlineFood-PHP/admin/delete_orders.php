<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

echo $_GET['order_del'];
$sql=mysqli_query($db,"DELETE FROM user_orders WHERE uo_id = '".$_GET['order_del']."'");
$sql1=mysqli_query($db,"DELETE FROM order_items WHERE uo_id = '".$_GET['order_del']."'");
//
echo "<script>alert('Order Deleted Successfully');</script>";
header("location:all_orders.php");  

?>
