<?php
include "../../connect_db/connect_sql.php";

$custID = $_GET['custID'];
$prodID = $_GET['prodID'];
$quantity = $_GET['quantity'];

$stmt = $conn->prepare("UPDATE product SET amount = amount - ? WHERE prodID = ?");
// Bind parameters
$stmt->bind_param("ss",$quantity, $prodID);
if ($stmt->execute()) {
        echo "
        <style>
            .container {
                text-align: center;
                padding: 50px;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                margin: 10px;
                border: none;
                border-radius: 5px;
                background-color: #4CAF50;
                color: white;
                cursor: pointer;
            }
            .button:hover {
                background-color: #45a049;
            }
        </style>";
    echo "
    <div class=container>
        <h2>เพิ่มลงสู่ตระก้าแล้ว</h2>
        <p>ทำรายการต่อหรือไม่</p>
        <button class=button onclick=continueShopping()>ทำรายการต่อ</button>
        <button class=button onclick=goToCart()>ไปที่ตระก้าสินค้า</button>
    </div>";
    echo "
    <script>
        function continueShopping() {
            window.location.href = '../view/showproduct.php'; // แทนที่ด้วย URL ของหน้าสินค้าหรือหน้าหลัก
        }

        function goToCart() {
            window.location.href = '../view/showbasketall.php'; // แทนที่ด้วย URL ของหน้าตระก้าสินค้า
        }
    </script>";
}else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>