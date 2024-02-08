<?php
include "../../connect_db/connect_sql.php";

$headID = $_GET['headID'];

$query = "SELECT * FROM hearder WHERE hearID ='$headID'";
$result = $conn->query($query);

require '../controlbar/Navbarcustomer.html';

echo "
<style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .edit-btn, .delete-btn {
        border: none;
        background: none;
        cursor: pointer;
        }

        .edit-btn img, .delete-btn img {
            width: 120%;
        }

        .order-details {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            max-width: 600px;
            margin: auto;
        }

        .order-section {
            margin-bottom: 20px;
        }

        .order-section h2 {
            border-bottom: 2px solid #0B60B0;
            padding-bottom: 5px;
        }

        .product-details {
            margin: 10px 0;
        }

         #orderButton {
            background-color: #C70039;
            color: white;
            padding: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-container {
            text-align: center;
        }
        .confirm-button {
            padding: 10px 25px;
            background-color: #4CAF50; /* Green color, you can change it to match your site */
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            transition: background-color 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
        }
        .confirm-button:hover {
            background-color: #45a049; /* Darker shade of button color for hover state */
        }

    </style>
";

echo "
<br/>
<table border='0' style='width: 60%; border-collapse: collapse; margin: auto; padding-top: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);'>
    <tr style='background-color: #0A2647; color: white; text-align: center;'>
        <th width='200px;' style='padding: 10px;' >ข้อมูลการสั่งซื้อ</th>
    </tr>
</table>
";
$status = '';
if($result){
    $data = $result->fetch_assoc();
    $headID = $data['hearID'];
    $customer_name = $data['customer_name'];
    $shipping_name = $data['shipping_name'];
    $payment_name = $data['payment_name'];
    $shipping_address = $data['shipping_address'];
    $phone_number = $data['phone_number'];
    $TaxID = $data['TaxID'];
    $order_date = $data['order_date'];
    $sent_date = $data['sent_date'];
    $recipt_date = $data['recipt_date'];
    $success_date = $data['success_date'];
    $status = $data['status'];
    // echo "$headID ,  $customer_name , $shipping_name , $payment_name , $order_date";
    echo "
    <table border='0' style='width :60%; border-collapse: collapse; margin: auto;'>
                            <tr>
                                <th width='50%;' style='padding: 10px;'><h2>ใบรายการการสั่งซื้อ</h2></th>
                                <th width='5%;' style='padding: 10px;'></th>
                                <th width='21%;' style='padding: 10px; text-align: start;'><a>Beluga Group (th) Co.,ltd <br><hr></a>
                                <a style='font-weight: normal;'>888, ถนนประชาสำราญ เขตหนองจอก กรุงเทพมหานคร <br> โทร 02-888-8888</a></th>
                            </tr>
                             <tr>
                                <th width='50%;' style='padding: 10px; text-align: start;'>
                                    <a style='font-weight: bold;'>ข้อมูลผู้ซื้อ <br></a>
                                    <br>
                                    <a>ชื่อผู้สั่ง : <a style='font-weight: normal;'> $customer_name </a><br></a>
                                    <a>ชื่อผู้รับ : <a style='font-weight: normal;'> $shipping_name </a><br></a>
                                    <a>ชื่อผู้จ่ายเงิน : <a style='font-weight: normal;'>$payment_name</a><br></a>
                                    <a>หมายเลขกำกับภาษี : <a style='font-weight: normal;'>$TaxID </a><br></a>
                                    <a>ที่อยู่จัดส่ง : <a style='font-weight: normal;'>$shipping_address </a><br></a>
                                    <a>หมายเลขโทรศัพท์ : &nbsp;&nbsp;<a style='font-weight: normal;'>$phone_number </a><br></a>
                                </th>

                                <th width='5%;' style='padding: 5px;'></th>

                                <th width='30%;' style='padding: 5px; text-align: start;'>
                                    <br><br><br><br><br><br>
                                    <a>วันที่สั่ง : <a style='font-weight: normal;'>$order_date</a><br></a>
                                    <a>วันที่ส่ง : <a style='font-weight: normal;'>$sent_date</a><br></a>
                                    <a>วันที่รับ : <a style='font-weight: normal;'>$recipt_date</a><br></a>
                                    <a>วันที่ยืนยันสินค้า : <a style='font-weight: normal;'>$success_date</a><br></a>
                                </th>
                            </tr>
                        </table>

                        <hr width= '60%;' />

                        <table border='0' style='width :60%; border-collapse: collapse; margin: auto;'>
                            <tr>
                                <th width='60%;' style='padding: 10px; text-align: start;'><a style='font-weight: bold;'>รายการที่สั่งซื้อ</a></th>
                                <th width='8%;' style='padding: 10px; text-align: center;'><a style='font-weight: bold;'>จำนวน</a></th> 
                                <th width='13%;' style='padding: 10px; text-align: center;'><a style='font-weight: bold;'>ราคาต่อหน่วย</a></th>
                                <th width='10%;' style='padding: 10px; text-align: center;'><a style='font-weight: bold;'>ราคารวม</a></th>
                            </tr>
    ";

}
else{ echo "Error: " . $conn->error;}



$query = "SELECT * FROM detail 
          INNER JOIN product ON detail.prodID = product.prodID
          WHERE hearID ='$headID'";

$result = $conn->query($query);
$count = 0;
$total = 0;
if ($result) {
    // The query was successful
    while ($row = $result->fetch_assoc()) {
        $count+=1;
        $prodName = $row['prodName'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $totalprice = $row['totalprice'];
        $total = $total+$totalprice;
        echo "
        <tr>
            <th width='60%;' style='padding: 10px; text-align: start;'><a style='font-weight: normal;'>$count . $prodName</a></th>
            <th width='8%;' style='padding: 10px; text-align: center;'><a style='font-weight:normal;'>$quantity</a></th> 
            <th width='13%;' style='padding: 10px; text-align: center;'><a style='font-weight:normal;'>$price</a></th>
            <th width='10%;' style='padding: 10px; text-align: center;'><a style='font-weight:normal; '>$totalprice</a></th>
        </tr>
        ";
    }
    echo "
    <table border='1' style='width :60%; border-collapse: collapse; margin: auto;'>
        <tr>
            <th width='60%;' style='padding: 10px; text-align: start; '>จำนวนรวมทั้งสิ้น</th>
            <th width='20%;' style='padding: 10px; text-align: center; font-weight: normal;'>$count รายการ</th>
            <th width='20%;' style='padding: 10px; text-align: end; font-weight: normal;'>$total บาท</th>
        </tr>
    </table>
    ";
    if ($status == "จัดส่งสำเร็จ"){
        echo "<br/>";
        echo "
        <form method='post' action='accept_delivery.php' class=button-container>
            <input type='hidden' name='headID' value='<?php echo $headID; ?>'>
            <input type='submit' class='confirm-button' value='ตรวจสอบและยอมรับสินค้า'>
        </form>
        ";
    }
    echo "<br/><br/>";
    require '../controlbar/footer.html';
} else {
    // Handle errors, the query failed
    echo "Error: " . $conn->error;
}


$conn->close();
?>