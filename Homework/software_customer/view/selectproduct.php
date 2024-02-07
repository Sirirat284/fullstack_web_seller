<?php
include "../../connect_db/connect_sql.php";

session_start();
$custID = $_SESSION['custID'];
$prodID = $_GET['prodID'];
// Prepare and execute the query
$query = "SELECT * FROM product WHERE prodID = '$prodID'";
$result = $conn->query($query);

require '../controlbar/Navbarcustomer.html';

if($result){
    $data = $result->fetch_assoc();
    $prodName = $data['prodName'];
    $prodType = $data['prodType'];
    $brand = $data['brand'];
    $detail = $data['detail'];
    $amount = $data['amount'];
    $price = $data['price'];
    $pathphoto = $data['pathphoto'];
    echo '<head>
            <!-- ... other head elements ... -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        </head>';
    echo"
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .product-container {
            display: flex;
            padding: 20px;
            background-color: white;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            flex: 50%;
            padding: 20px;
            text-align: center;
        }
        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product-details {
            flex: 50%;
            padding: 20px;
        }
        .product-details h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .quantity-selector {
            margin-bottom: 20px;
        }
        .quantity-selector input {
            width: 50px;
            padding: 5px;
            margin-right: 10px;
        }
        .order-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .order-button:hover {
            background-color: #45a049;
        }
        h2 {
            color: #2E86C1; /* สีน้ำเงิน */
            font-weight: bold;
        }
        h4 {
            color: #27AE60; /* สีเขียว */
            font-weight: bold;
        }
        p {
            color: #333; /* สีเทาเข้ม */
            margin-bottom: 10px;
        }
        .price, .amount {
            font-weight: bold;
            color: #D35400; /* สีส้ม */
        }
    </style>
    ";
    echo "
    <div class='product-container'>
        <div class='product-image'>
            <img src='../../software_admin/model/photo/$pathphoto'' alt='Product Image'>
        </div>
        <div class='product-details'>
            <h2>$prodName</h2>
            <h4>รายละเอียด :</h4>  
            <p>$detail</p>
            <p class=price>ราคา : $price</p>
            <p class=amount>จำนวนคงเหลือ : $amount </p>
            <form action=../controller/addbasket.php method=GET>
            <input type='hidden' name='prodID' value= $prodID>
            <input type='hidden' name='custID' value= $custID>
                <div class='quantity-selector'>
                    <label for='quantity'>Quantity:</label>
                    <input type='number' id='quantity' name='quantity' value='1' min='1' onchange='checkQuantity()'>
                    <span id='quantity-warning' style='color: red; display: none;'>จำนวนที่เลือกมากกว่าจำนวนในสต็อก</span>
                </div>
                <button type=submit class='order-button' onclick=confirmOrder() >Order Now</button>
            </form>
        </div>
    </div>
    ";
    echo "
    <script>
    var maxAmount = $amount;
    function checkQuantity() {
        var selectedQuantity = document.getElementById('quantity').value;
        var warningElement = document.getElementById('quantity-warning');

        if (parseInt(selectedQuantity) > maxAmount) {
            warningElement.style.display = 'block';
        } else {
            warningElement.style.display = 'none';
        }
    }
    </script>
    ";
    require '../controlbar/footer.html';

}


$conn->close();
?>