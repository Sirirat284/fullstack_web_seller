<?php
include "../../connect_db/connect_sql.php";

$query = "SELECT * FROM customer ORDER BY custID DESC LIMIT 1;";
$result = $conn->query($query);
if ($result) {
    $lastdata = $result->fetch_assoc();
    $lastid = $lastdata['custID'];

    // แยกส่วนตัวอักษรและตัวเลข
    $prefix = "cust";
    $number = preg_replace('/[^0-9]+/', '', $lastid);

    // เพิ่มตัวเลขและรักษาจำนวนหลัก
    $newNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);

    // รวมกลับเข้าด้วยกัน
    $newId = $prefix . $newNumber;

    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO customer (custID, first_name,last_name, gender, phone_number, address,email) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss",$newId , $firstname , $lastname , $gender , $phone_number , $address,$email);


    if ($stmt->execute()) {
        // echo "Insert data = <span style='color:red;'> '$a1' </span> is Successful.";
        
    echo "
        <div style='margin: auto; width: 50%; padding: 20px; text-align: center; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>
            <h2>Insert Data</h2>
            <p style = 'color: red;' >Insert data Successful.</p>
            <p> ชื่อ : $firstname $lastname</p>
            <a href='../view/insertcustomer.html' style='display: inline-block; padding: 10px 20px; margin: 10px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;'>ย้อนกลับ</a>
            <a href='../view/showallcustomer.php' style='display: inline-block; padding: 10px 20px; margin: 10px; background-color: #008CBA; color: white; text-decoration: none; border-radius: 5px;'>หน้ารวมข้อมูล</a>
        </div>
        ";

    ;
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>