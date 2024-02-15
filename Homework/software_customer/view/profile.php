<?php
include "../../connect_db/connect_sql.php";

session_start();
$custID = $_SESSION['custID'];

$query = "  SELECT * FROM customer WHERE custID='$custID'";
$result = $conn->query($query);
 

if($result){
    require '../controlbar/Navbarcustomer.html';
    echo "<style>
            .container {
                display: flex;
                justify-content: center;
                align-items: flex-start;
                height: 62vh;
                padding-top: 50px;
                gap: 20px;
            }
            .menu {
                margin-right: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                overflow: hidden;
                width: 200px;
            }
            .profile,
            .order-history {
              padding: 10px;
              background-color: #f9f9f9;
              border-bottom: 1px solid #ddd;
              color: #333;
              text-align: center;
            }
            .active {
              background-color: #ffc107;
            }
            .customer-info {
              width: 600px;
              border: 1px solid #ddd;
              border-radius: 5px;
              padding: 20px;
              background-color: #fff;
            }
            .edit-button {
              background-color: #ffc107;
              color: white;
              padding: 10px 15px;
              text-align: center;
              display: block;
              width: 100px;
              margin-top: 20px;
              text-decoration: none;
              border-radius: 5px;
            }          
        </style>";
    
    $row = $result->fetch_assoc();
    $custName = $row['first_name'];
    $custLastName = $row['last_name'];
    $gender = $row['gender'];
    $phoneNum = $row['phone_number'];
    $address = $row['address'];
    $email = $row['email'];

    echo "
        <div class=container>
            <div class=menu>
                <div class=profile>
                    <a href=../view/profile.php>โปรไฟล์</a>
                </div>
                <div class=order-history>
                    <a href=../view/histrotyorder.php>ประวัติการสั่งซื้อ</a>
                </div>
            </div>
            <div class=customer-info>
                <center><h2>โปรไฟล์</h2></center>
                <p>ชื่อ: $custName</p>
                <p>นามสกุล: $custLastName</p>
                <p>เพศ: $gender</p>
                <p>เบอร์โทรศัพท์: $phoneNum</p>
                <p>ที่อยู่: $address</p>
                <p>email: $email</p>
                <a href=# class=edit-button>แก้ไข</a>
            </div>
        </div>
        ";
    require '../controlbar/footer.html';
}else{
    echo "Error: " . $conn->error;
}
$conn->close();
?>