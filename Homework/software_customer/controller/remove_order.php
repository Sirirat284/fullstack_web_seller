<?php
include "../../connect_db/connect_sql.php";

session_start();
$custID = $_SESSION['custID'];

$stmt = $conn->prepare("DELETE FROM orderbuy WHERE custID = ?");
// Bind parameters
$stmt->bind_param("s",$custID);



// Execute the statement
if ($stmt->execute()) {
    // echo "Delete data = <Font color-red> '$a1' </Font> is Successful.";
    echo "
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            color: #4CAF50;
        }

        .receipt-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }
    </style>
    ";
    echo "
    <body>
        <div class=container>
            <h2>สั่งซื้อเสร็จสิน</h2>
            <p>ขอบคุณที่ทำรายการสั่งซื้อกับเรา!</p>
            <a href='../view/showbill.php' class=receipt-button>ไปยังใบเสร็จ</a>
        </div>
    </body>
    ";
} else {
    echo "Error: " . $stmt->error;
}
// Close the statement and connection
$stmt->close();
$conn->close();
?>
