<?php
include "../../connect_db/connect_sql.php";

$id = $_POST['customerID'];
// Prepare and execute the query
$query = "SELECT * FROM customer WHERE custID = '$id'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    // ID found, redirect to next page with custID
    session_start(); // เริ่ม Session
    // ตั้งค่าค่า custID ใน Session
    $_SESSION['custID'] = $id;
    header("Location: ../view/showproduct.php"); // Replace 'next_page.php' with your actual next page
} else {
    // ID not found, show alert and redirect back to login page
    echo "<script>
        alert('Customer ID not found. Please try again.');
        window.location.href='../view/login.html'; // Replace 'login_page.php' with your actual login page
    </script>";
}





$conn->close();
?>