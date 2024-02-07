<?php
include "../../connect_db/connect_sql.php";
include "generate_function.php";

session_start();
$custID = $_SESSION['custID'];

$customer_name = $_GET['customer_name'];
$shipping_name =$_GET['shipping_name'];
$payment_name=$_GET['payment_name'];
$tax = $_GET['tax'];
$shipping_address=$_GET['shipping_address'];
$phone_number=$_GET['phone_number'];
$status = "กำลังเตรียมสินค้า";

$generate_class = new generate_class();
$result = $generate_class->generate_header($custID, $customer_name, $shipping_name, $payment_name, $tax, $shipping_address, $phone_number, $status);
// echo "$custID , $customer_name , $shipping_name , $payment_name ,$tax , $shipping_address , $phone_number ";
if ($result) {
    
} else {
    // Handle error if unable to generate the header
    echo "Error: Unable to generate header";
}

// If the header was successfully generated, attempt to retrieve the latest header ID
$latestHeaderID = $generate_class->get_headID();

if ($latestHeaderID !== false) {
    // If successfully retrieved, display the latest header ID
    echo "Latest Header ID: " . $latestHeaderID;
} else {
    // Handle error if unable to retrieve the latest header ID
    echo "Error: Unable to retrieve the latest header ID.";
}

$generate_class->generate_detail($latestHeaderID ,$custID );




$conn->close();
?>
