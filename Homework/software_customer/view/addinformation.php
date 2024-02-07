<?php
    include "../../connect_db/connect_sql.php";

    session_start();
    $custID = $_SESSION['custID'];

    $query = "SELECT * FROM customer WHERE custID ='$custID' ";
    $result = $conn->query($query);

    if($result){
        $data = $result->fetch_assoc();
        $IDCust = $data['custID'];
        $firstname = $data['first_name'];
        $lastname = $data['last_name'];
        $gender = $data['gender'];
        $phone_number = $data['phone_number'];
        $address = $data['address'];
        $email = $data['email'];

        echo "
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto;
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
        }

        .form-group input[type=text] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
        ";
    echo "
    <body>
    <div class=container>
        <h2>กรอกรายละเอียดการสั่งซื้อ</h2>
        <form action=../controller/generatebill.php method=get>
            <div class=form-group>
                <label for=customer_name>ชื่อผู้สั่งซื้อสินค้า:</label>
                <input type=text id=customer_name name=customer_name value='$firstname $lastname'>
            </div>

            <div class=form-group>
                <label for=shipping_name>ชื่อผู้รับสินค้า:</label>
                <input type=text id=shipping_name name=shipping_name>
            </div>

            <div class=form-group>
                <label for=payment_name>ชื่อผู้ชำระเงิน:</label>
                <input type=text id=payment_name name=payment_name>
            </div>
            <div class=form-group>
                <label for=shipping_address>เลขประจำตัวผู้เสียภาษี:</label>
                <input type=text id=shipping_address name=tax>
            </div>

            <div class=form-group>
                <label for=shipping_address>ที่อยู่ที่จัดส่ง:</label>
                <input type=text id=shipping_address name=shipping_address value = '$address'>
            </div>

            <div class=form-group>
                <label for=phone_number>เบอร์โทรศัพท์:</label>
                <input type=text id=phone_number name=phone_number value='$phone_number'>
            </div>

            <div class=form-group>
                <input type=submit value=ยืนยันการสั่งซื้อ>
            </div>
        </form>
    </div>
</body>
    ";

    }else{
        echo "Error: " . $conn->error;
    }


?>