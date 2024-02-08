<?php
include "../../connect_db/connect_sql.php";

session_start();
$custID = $_SESSION['custID'];

$query = "  SELECT * FROM hearder WHERE custID='$custID'AND status <> 'ปิดการขาย'";
$result = $conn->query($query);
 

if($result){
    require '../controlbar/Navbarcustomer.html';
    echo "<h2>รายการสินค้าที่สั่ง</h2>";
    echo "
    <style>
                .insert-section {
                    display: flex;
                    justify-content: space-between;
                    padding: 1px ;
                }
                .customer-data {
                    font-size: 20px;
                    margin-left: 50px;
                    color: #333; /* Dark grey color */
                }
                .insert-button {
                    display: block;
                    text-align: right; /* Align button to the right */
                    padding: 10px ;
                    margin-right: 50px;
                }

                .insert-button a {
                    background-color: #4CAF50; /* Green background */
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 5px; /* Rounded corners */
                    transition: background-color 0.3s; /* Smooth transition for background */
                }

                .insert-button a:hover {
                    background-color: #45a049; /* Darker green on hover */
                }
                table {
                    width: 1200px;
                    border-collapse: collapse;
                    margin: auto;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                th:first-child {
                    border-top-left-radius: 10px; /* Rounded top-left corner */
                }
                th:last-child {
                    border-top-right-radius: 10px; /* Rounded top-right corner */
                }
                th {
                    background-color: #0085E8;
                    color: white;
                    padding: 10px;
                }
                td {
                    padding: 10px;
                    text-align: center;
                    border-bottom: 1px solid #ddd;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
                .detail-link {
                    color: blue; /* Sets the text color to blue */
                    text-decoration: underline; /* Adds an underline */
                }
            </style>
    ";
    echo "<table>
    <tr>
        <th width='50px'>No</th>
        <th width='200px'>ชื่อผู้สั่ง</th>
        <th width='200px'>ชื่อผู้รับ</th>
        <th width='200px'>ชื่อผู้จ่ายเงิน</th>
        <th width='150px'>วันที่สั่ง</th>
        <th width='150px'>สถานะ</th>
        <th width='120px'></th>
    

    </tr>";
    $count = 0;
    while ($data = $result->fetch_assoc()) {
        $headID = $data['hearID'];
        $customer_name = $data['customer_name'];
        $shipping_name = $data['shipping_name'];
        $payment_name = $data['payment_name'];
        $order_date = $data['order_date'];
        $status = $data['status'];
        $count++;

        echo "
        <tr>
        <td>$count</td>
        <td>$customer_name</td>
        <td>$shipping_name</td>
        <td>$payment_name</td>
        <td>$order_date</td>";
        if ($status == "จัดส่งสำเร็จ") {
            echo "<td style='color: #4CAF50; font-weight: bold;'>$status</td>";
        } else {
            echo "<td>$status</td>";
        }
        echo "<td>
        <form method='get' action='detailbill.php'>
            <input type='hidden' name='headID' value='$headID'>
            <input type='submit' class='detail-link' value='รายละเอียด>>' style='background:none;border:none;color:blue;text-decoration:underline;cursor:pointer;'>
        </form>
        </td>
        </tr>";
    }
    echo "</table>";
    echo "<br/>";
    require '../controlbar/footer.html';
}else{
    echo "Error: " . $conn->error;
}

$conn->close();
?>