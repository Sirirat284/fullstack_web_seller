<?php
include "../../connect_db/connect_sql.php";


session_start();
$custID = $_SESSION['custID'];
// Prepare and execute the query
$query = "SELECT * FROM product ";
$result = $conn->query($query);

if($result){
    require '../controlbar/Navbarcustomer.html';
    echo "  <title>ข้อมูลสินค้า</title>";
    echo "
    <style>
    .product-grid {
      display: flex;
      flex-wrap: wrap;
      padding: 20px;
      justify-content: space-around;
    }
    .product-card {
      width: 220px;
      margin: 10px;
      border: 1px solid #ddd;
      padding: 20px;
      box-shadow: 2px 2px 10px #ccc;
      text-align: center;
    }
    .product-card img {
      max-width: 100%;
      height: auto;
    }
    .product-name {
      font-size: 18px;
      color: #333;
      margin: 10px 0;
    }
    .product-price {
      font-size: 16px;
      color: #666;
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
    </style>
    ";

    echo "<div class='product-grid'>";
    $count = 0;
    while ($row = $result->fetch_assoc()) {
        $prodID = $row['prodID'];
        $prodName = $row['prodName'];
        $prodType = $row['prodType'];
        $brand = $row['brand'];
        $detail = $row['detail'];
        $amount = $row['amount'];
        $price = $row['price'];
        $pathphoto = $row['pathphoto'];
        $count = $count+1;
        echo " 
        <div class=product-card>
      <img src= '../../software_admin/model/photo/$pathphoto' alt=Product Image>
      <h3 class=product-name>$prodName</h3>
      <p class=product-brand>$brand</p>
      <p class=product-amount>Amount:  $amount</p>
      <p class=product-price>฿ $price</p>
      <form method=get action=selectproduct.php>
        <input type=hidden name=prodID value= $prodID>
        <input type=hidden name=custID value=$custID>
        <button type=submit class=order-button>Order</button>
      </form>
    </div>
        ";
    }
    echo "</div>";

    require '../controlbar/footer.html';
}
else{
    echo "Error: " . $conn->error;
}
// session_destroy();
$conn->close();
?>