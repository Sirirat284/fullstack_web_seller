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
    // echo "Update data = <span style='color:red;'> '$IDCust' </span> is Successful.";
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Update Successful</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                text-align: center;
                padding: 50px;
            }
            .message-box {
                background-color: #fff;
                border-radius: 5px;
                display: inline-block;
                padding: 30px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .success-message {
                color: #4CAF50;
                margin-bottom: 20px;
            }
            .info {
                margin-bottom: 20px;
            }
            .back-btn {
                background-color: #4CAF50;
                color: #ffffff;
                border: none;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            .back-btn:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class='message-box'>
            <div class='success-message'>Update Successful!</div>
            <div class='info'>Customer ID: <span style='color:red;'>$IDCust</span></div>
            <a href='../view/showallcustomer.php' class='back-btn'>Go Back to Customer List</a>
        </div>
    </body>
    </html>";

} else {
    echo "Error: " . $stmt->error;
}
// Close the statement and connection
$stmt->close();
$conn->close();
?>