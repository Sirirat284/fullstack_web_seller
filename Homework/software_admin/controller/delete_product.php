<?php
include "../../connect_db/connect_sql.php";

// Set values for parameters
$id = $_POST['prodID'];

$stmt = $conn->prepare("DELETE FROM product WHERE prodID = ?");
// Bind parameters
$stmt->bind_param("s",$id);



// Execute the statement
if ($stmt->execute()) {
    // echo "Delete data = <Font color-red> '$a1' </Font> is Successful.";
    header("Location: ../view/showallproduct.php");
} else {
    echo "Error: " . $stmt->error;
}
// Close the statement and connection
$stmt->close();
$conn->close();
?>
