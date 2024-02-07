<?php
include "../../connect_db/connect_sql.php";

function uploadImageAndGetFilename($fileInputName, $uploadDir = "../model/photo/") {
    $response = array(
        'success' => false,
        'filename' => '',
        'error' => ''
    );

    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]["error"] == 0) { //ตรวจสอบว่ามีไฟล์ถูกอัปโหลดและไม่มีข้อผิดพลาด.
        $allowed_types = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"); //อาร์เรย์ที่กำหนดประเภทไฟล์ที่อนุญาต (jpg, jpeg, gif, png).
        $file_name = $_FILES[$fileInputName]["name"];
        $file_type = $_FILES[$fileInputName]["type"];
        $file_size = $_FILES[$fileInputName]["size"];

        $ext = pathinfo($file_name, PATHINFO_EXTENSION); //รับนามสกุลไฟล์จากชื่อไฟล์ที่อัปโหลด.
        if (!array_key_exists($ext, $allowed_types)) { //ตรวจสอบว่านามสกุลไฟล์อยู่ในรายการที่อนุญาตหรือไม่.
            $response['error'] = "Error: Please select a valid file format.";
            return $response;
        }

        $maxsize = 5 * 1024 * 1024;
        if ($file_size > $maxsize) { //ตรวจสอบว่าขนาดไฟล์ไม่เกินขีดจำกัดที่กำหนด (5 MB).
            $response['error'] = "Error: File size is larger than the allowed limit.";
            return $response;
        }

        if (in_array($file_type, $allowed_types)) { //ตรวจสอบว่าประเภทไฟล์อยู่ในรายการที่อนุญาตหรือไม่.
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true); // สร้างโฟลเดอร์เป้าหมายหากยังไม่มี.
            }
            $destination = $uploadDir . $file_name;
            
            if (file_exists($destination)) { 
                $response['success'] = true; // Set success to true even if file already exists
                $response['filename'] = $file_name; // Return the existing file name
            } else {
                if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $destination)) { //ตรวจสอบว่าไฟล์นี้มีอยู่แล้วในเซิร์ฟเวอร์หรือไม่.
                    $response['success'] = true;
                    $response['filename'] = $file_name;
                } else {
                    $response['error'] = "There was an error uploading your file. Please try again.";
                }
            }
        } else {
            $response['error'] = "Error: There was a problem uploading your file - please try again.";
        }
    } else {
        $response['error'] = "Error: " . $_FILES[$fileInputName]["error"];
    }

    return $response;
}


$query = "SELECT * FROM product ORDER BY prodID DESC LIMIT 1;";
$result = $conn->query($query);
if ($result) {
    $lastdata = $result->fetch_assoc();
    $lastid = $lastdata['prodID'];

    // แยกส่วนตัวอักษรและตัวเลข
    $prefix = "prod";
    $number = preg_replace('/[^0-9]+/', '', $lastid);

    // เพิ่มตัวเลขและรักษาจำนวนหลัก
    $newNumber = str_pad((int)$number + 1, strlen($number), '0', STR_PAD_LEFT);

    // รวมกลับเข้าด้วยกัน
    $newId = $prefix . $newNumber;

    $prodName = $_POST['prodName'];
    $prodType = $_POST['prodtype'];
    $brand = $_POST['brand'];
    $detail = $_POST['detail'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $uploadResult = uploadImageAndGetFilename("image");
    $pathphoto = $uploadResult['filename'];

    $stmt = $conn->prepare("INSERT INTO product (prodID, prodName,prodType, brand, detail, amount,price,pathphoto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss",$newId , $prodName , $prodType , $brand , $detail , $amount,$price,$pathphoto);

    // echo "$pathphoto";
    // echo "<p>id : $newId <br> name : $prodName <br> type : $prodType <br> brand : $brand <br>deteil : $detail <br> amount : $amount <br>price : $price <br> path : $pathphoto</p>";
    if ($stmt->execute()) {
    echo "
        <div style='margin: auto; width: 50%; padding: 20px; text-align: center; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>
            <h2>Insert Data</h2>
            <p style = 'color: red;' >Insert data Successful.</p>
            <p> ชื่อ : $prodName</p>
            <a href='../view/insertproduct.html' style='display: inline-block; padding: 10px 20px; margin: 10px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;'>ย้อนกลับ</a>
            <a href='../view/showallproduct.php' style='display: inline-block; padding: 10px 20px; margin: 10px; background-color: #008CBA; color: white; text-decoration: none; border-radius: 5px;'>หน้ารวมข้อมูล</a>
        </div>
        ";
    } else {
        echo "Error: " . $stmt->error;
    }

}

$stmt->close();
$conn->close();
?>