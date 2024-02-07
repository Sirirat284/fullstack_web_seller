<?php
include "../../connect_db/connect_sql.php";

session_start();
$custID = $_SESSION['custID'];

$query = " SELECT * FROM basket 
            INNER JOIN product ON basket.prodID = product.prodID
            WHERE custID='$custID'";
$result = $conn->query($query);

if($result){
    require '../controlbar/Navbarcustomer.html';
    
    echo "
    <style>
        .insert-section {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background-color: #e7f3fe; /* สีฟ้าอ่อน */
            border-bottom: 2px solid #blue; /* เส้นขอบสีน้ำเงิน */
        }
        .customer-data {
            font-size: 20px;
            margin-left: 50px;
            color: #333; /* สีเทาเข้ม */
            font-weight: bold; /* ตัวหนา */
        }
        .insert-button a {
            background-color: #007bff; /* สีน้ำเงิน */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .insert-button a:hover {
            background-color: #0056b3; /* สีน้ำเงินที่เข้มขึ้นเมื่อ hover */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th {
            background-color: #007bff; /* สีน้ำเงิน */
            color: white;
            padding: 10px;
            border-right: 1px solid white; /* เพิ่มเส้นขอบขาวระหว่างคอลัมน์ */
        }
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    ";

echo "<table>
    <tr>
        <th width='50px'>ลำดับ</th>
        <th width='350px'>รูปภาพ</th>
        <th width='150px'>ชื่อสินค้า</th>
        <th width='150px'>ราคา/หน่วย</th>
        <th width='100px'>จำนวน</th>
        <th width='100px'>ราคารวม</th>
    </tr>";
    $count = 0;
    $totalSum = 0;
    while ($data = $result->fetch_assoc()) {
        $pathphoto = $data['pathphoto'];
        $prodName = $data['prodName'];
        $price = $data['price'];
        $quantity =$data['quantity'];
        $totalprice = $quantity * $price;
        $count = $count+1;
        $totalSum += $totalprice;
        echo "<div>";
        echo "
        <tr>
        <td>$count</td>
        <td><img width=300 height=300 src='../../software_admin/model/photo/$pathphoto'/></td>
        <td>$prodName</td>
        <td>$price</td>
        <td>$quantity</td>
        <td>$totalprice</td>
        </tr>
        ";
    }
    echo "
    <tr>
        <td colspan='5' style='text-align: right; font-weight: bold; background-color: #4CAF50; color: white; font-size: 20px;'>รวมยอดทั้งหมด:</td>
        <td style='font-weight: bold; background-color: #4CAF50; color: white; font-size: 20px;'>$totalSum</td>
    </tr>
    <tr>
        <td colspan='6' style='text-align: center;'>
            <a href='addinformation.php' style='display: inline-block; background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; font-size: 16px;'>ยืนยันการสั่งซื้อ</a>
        </td>
    </tr>"; 
    echo "</div> </table>";
    require '../controlbar/footer.html';
}else{
    echo "Error: " . $conn->error;
}

$conn->close();
?>