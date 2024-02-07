<?php
include "../../connect_db/connect_sql.php";

// Set values for parameters
$IDCust = $_POST['IDCust'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];

$stmt = $conn->prepare("UPDATE customer SET first_name = ?,last_name = ?, gender = ?, phone_number = ?, address = ?, email = ? WHERE custID = ?");
// Bind parameters
$stmt->bind_param("sssssss", $firstname, $lastname, $gender,  $phone_number, $address, $email, $IDCust);

// echo "pass $IDCust , $firstname , $lastname ,  $gender, $address, $phone_number, $email";
// Execute the statement
if ($stmt->execute()) {
    echo "Update data = <span style='color:red;'> '$IDCust' </span> is Successful.";
} else {
    echo "Error: " . $stmt->error;
}
// Close the statement and connection
$stmt->close();
$conn->close();
?>