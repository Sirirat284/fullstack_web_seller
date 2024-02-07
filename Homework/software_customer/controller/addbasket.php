<?php
include "../../connect_db/connect_sql.php";

$custID = $_GET['custID'];
$prodID = $_GET['prodID'];
$quantity = $_GET['quantity'];

$stmt = $conn->prepare("INSERT INTO basket (custID, prodID, quantity ) VALUES (?, ?, ?)");
$stmt->bind_param("sss",$custID,$prodID,$quantity);


if ($stmt->execute()) {
    // echo "Insert data = <span style='color:red;'> '$a1' </span> is Successful.";
    header("Location: update_amont.php?prodID=$prodID,quantity=$quantity,custID=$custID");
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();

?>