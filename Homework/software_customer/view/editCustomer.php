<?php
include "../../connect_db/connect_sql.php";

$ID = $_SESSION['IDCust'];

// Prepare and execute the query
$query = "SELECT * FROM customer WHERE custID = '$ID' ";
$result = $conn->query($query);

// Check if the query was successful
if ($result) {

    $data = $result->fetch_assoc();
    $firstname = $data['first_name'];
    $lastname = $data['last_name'];
    $gender = $data['gender'];
    $phone_number = $data['phone_number'];
    $address = $data['address'];
    $email = $data['email'];
    
    echo "<style>
    body {
        background-color: hsl(0, 0%, 100%);
        color: #000000;
        font-family: Arial, sans-serif;
        text-align: center;
    }
    h1 {
        color: #000000;
    }
    form {
        background-color: white;
        margin: auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 500px;
    }
    input[type=text], select, input[type='email'] {
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        width: calc(100% - 170px); /* ลบความกว้างของ label และ margin */
    }
    input[type=submit], input[type=reset] {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        background-color: #4CAF50; /* Green background */
        color: white;
        margin: 10px 0; /* กำหนด margin ให้เหมือนเดิม */
    }
    input[type=submit], input[type=reset] {
        cursor: pointer;
        margin-right: 0; /* ลบ margin ขวาออกเพื่อให้ align กับองค์ประกอบอื่นๆ */
    }
    input[type=submit] {
        background-color: #4CAF50;
    }
    input[type=reset] {
        background-color: #f44336;
    }
    /* Hover effect for the 'ยืนยัน' button */
    input[type=submit]:hover {
        background-color: #367a39; /* สีเขียวที่เข้มขึ้นเมื่อ hover */
        transition: background-color 0.3s ease-in-out;
    }
    /* Hover effect for the 'ยกเลิก' button */
    input[type=reset]:hover {
        background-color: #c13832; /* สีแดงที่เข้มขึ้นเมื่อ hover */
        transition: background-color 0.3s ease-in-out;
    }
    .form-group {
        margin-bottom: 10px;
        display: flex;
        align-items: center; /* ให้ตรงกันในแนวตั้ง */
    }
    label {
        flex: 0 0 150px; /* กำหนดขนาดคงที่สำหรับ label */
        text-align: right;
        margin-right: 10px;
    }
    .form-controls {
        text-align: center;
        margin-top: 20px;
    }

    /* Focus effect for inputs and select */
    input[type='text']:focus, select:focus, input[type='email']:focus {
        outline: none;
        border-color: #4CAF50;
    }
</style>";

    echo "<center>
            <h1>แก้ไขข้อมูลที่ต้องการ</h1> 
            <hr color=blue>
            <form method=post action='../controller/update_inform_cust.php'> 
                <div>
                    <div class=form-group>
                    <label for=a1>ชื่อ:</label>
                    <input id=a1 type=text  name=firstname maxlength=20 value=$firstname>
                </div>
                <div class=form-group>
                    <label for=a2>นามสกุล:</label>
                    <input id=a2 type=text  name=lastname maxlength=20 value=$lastname>
                </div>
                <div class=form-group>
                    <label for=a3>เพศ:</label>
                    <select id=a3 name=gender value=$gender>
                        <option value=\"Male\"" . ($gender == 'Male' ? " selected" : "") . ">ชาย</option>
                        <option value=\"Female\"" . ($gender == 'Female' ? " selected" : "") . ">หญิง</option>
                        <option value=\"Other\"" . ($gender == 'Other' ? " selected" : "") . ">อื่นๆ</option>
                    </select>
                </div>                
                <div class=form-group>
                    <label for=a4>ที่อยู่:</label>
                    <input id=a4 type=text  name=address maxlength=80 value=$address>
                </div>
                <div class=form-group>
                    <label for=a5>เบอร์โทรศัพท์:</label>
                    <input id=a5 type=text name=phone_number maxlength=10 value=$phone_number>
                </div>
                <div class=form-group>
                    <label for=a6>Email:</label>
                    <input id=a6 type=email   name=email maxlength=50 value=$email>
                </div>
                    <div class=form-controls>
                        <input type=submit value=อัปเดต>
                        <input type=reset value=ยกเลิก>
                    </div>
                </div>
            </form>
        </center>";

    $result->free();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>