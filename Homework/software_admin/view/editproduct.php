<?php
include "../../connect_db/connect_sql.php";

$ID = $_GET['prodID'];

// Prepare and execute the query
$query = "SELECT * FROM product WHERE prodID = '$ID' ";
$result = $conn->query($query);

// Check if the query was successful
if ($result) {

    $data = $result->fetch_assoc();
    $prodName = $data['prodName'];
    $prodType = $data['prodType'];
    $brand = $data['brand'];
    $detail = $data['detail'];
    $amount = $data['amount'];
    $price = $data['price'];
    $pathphoto = $data['filename'];
    
    echo "
    <style>
    body {
        background-color: hsl(0, 0%, 100%);
        color: #000000;
        font-family: Arial, sans-serif;
        text-align: center;
    }

    h1 {
        color: #333;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 600px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    label {
        margin-bottom: 5px;
    }

    input[type=text],
    select,
    input[type=number],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    input[type=submit],
    input[type=reset] {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        margin-right: 10px;
        cursor: pointer;
    }

    input[type=submit] {
        background-color: #5cb85c;
        color: white;
    }

    input[type=reset] {
        background-color: #f44336;
        color: white;
    }

    input[type=submit]:hover {
        background-color: #4cae4c;
    }

    input[type=reset]:hover {
        background-color: #d9534f;
    }

    .upload-wrapper {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        margin-bottom: 10px;
    }
    
    .file-name {
        flex-grow: 1;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        text-align: left;
        background-color: #f9f9f9;
        margin-right: 10px;
    }
    
    .upload-btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
    }
    
    .upload-btn:hover {
        background-color: #367a39;
    }
    .file-name {
        flex-grow: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
        background-color: #f9f9f9;
        text-align: left;
    }

    .form-controls {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }
</style>

    ";
    echo "<body>";
    echo "<center>
            <h1>เพิ่มข้อมูลที่ลูกค้าต้องการ</h1> 
            <hr color=black>
            <form method=post action=>
            <div>
            <h2>รหัสสินค้า : $ID</h2>
            <div class='upload-wrapper'>
                <span class='file-name'>No file chosen</span>
                <label for='a1;'Choose File</label>
                <input id='a1' type='file' name='image' accept='image/*' onchange='updateFileName(this)' >
            </div>
            <div class='form-group'>
                <label for='a2'>ชื่อสินค้า:</label>
                <input id='a2' type='text'  name='prodName' maxlength='99' value='$prodName'>
            </div>               
            <div class='form-group'>
                <label for='a3'>ประเภทสินค้า: </label>
                <select id='a3' name='prodtype' value = $prodType>
                    <option value=Laptop ".($prodType == 'labtop' ? " selected" : "") .">โน๊ตบุ๊ค</option>
                    <option value=PC ".($prodType == 'PC' ? " selected" : "") . ">คอมพิวเตอร์ พีซี</option>
                </select>
            </div> 
            <div class='form-group'>
                <label for='a4'>ยี่ห้อ:</label>
                <select id='a4' name='brand'>
                    <option value='asus'".($brand == 'asus' ? " selected" : "").">Asus</option>
                    <option value='acer'".($brand == 'acer' ? " selected" : "").">Acer</option>
                    <option value='apple'".($brand == 'apple' ? " selected" : "").">Apple</option>
                    <option value='dell'".($brand == 'dell' ? " selected" : "").">Dell</option>
                    <option value='lenovo'".($brand == 'lenovo' ? " selected" : "").">Lenovo</option>
                    <option value='msi'".($brand == 'msi' ? " selected" : "").">MSI</option>
                    <option value='hp'".($brand == 'hp' ? " selected" : "").">HP</option>
                </select>
            </div> 
            <div class='form-group'>
                <label for='a5'>รายละเอียด:</label>
                <textarea id='a5' name='detail' rows='4' cols='50' maxlength='200' >$detail</textarea>
            </div>
            <div class='form-group'>
                <label for='a6'>จำนวน:</label>
                <input id='a6' type='number'   name='amount' min='0' max='100' step='1' value=$amount>
            </div>
            <div class='form-group'>
                <label for='a7'>ราคา:</label>
                <input id='a7' type='number'   name='price' min='0' max='999999' step='1' value=$price>
            </div>
            <div class='form-controls'>
                <input type='submit' value='อัปเดต'>
                <input type='reset' value='ยกเลิก'>
            </div>
        </div> 
            </form>
        </center>";
    echo "    
    <script>
        function updateFileName(input) {
            var fileName = input.files && input.files.length > 0 ? input.files[0].name : No file chosen;
            document.querySelector('.file-name').textContent = fileName;
        }
    </script>";
    echo "</body>";

    $result->free();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>