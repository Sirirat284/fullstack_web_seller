<?php
$servername = "localhost:3306";
$username = "root";
$password = "bew224002544";
$dbname = "fullstack_cust_and_prod_service";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>