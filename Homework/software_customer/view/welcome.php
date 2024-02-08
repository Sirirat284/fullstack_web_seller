<?php
    include "../../connect_db/connect_sql.php";

    session_start();
    $custID = $_SESSION['custID'];

    $query = "SELECT * FROM product ";
    $result = $conn->query($query);

    if($result){
        require '../controlbar/Navbarcustomer.html';
        echo "
        <style>

        .position-img {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .position-brand {
            text-align: left; /* Aligns content inside to the left */
            width: 100%; /* Ensures the div takes the full width available */
            margin-top: 20px; /* Adds some space above the heading */
        }
        .position-brand h2 {
            margin-left: 150px;
        }
        .position-brand .logobrand {
            margin-left: 100px;
        }
        .position-brand .position_img_to_img {
            display: inline-block; /* or flex, depending on your layout */
            margin-left: 20px;
            margin-right: 20px;
        }        
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
        echo "
        <body>
            <div class='position-img'>
                <div class='image'>
                    <img widht='300' height='600' src='../model/picture/DALL·E 2024-02-06 11.03.53 - Design a 16_9 widescreen advertisement poster for a computer store with an inviting tagline. The poster showcases a modern, sleek interior filled with.webp'/>
                </div>          
            </div>
            <div class='position-brand'>
                <h2>รวบรวมแบนด์ชั้นนำมากมาย</h2>
                <div class='logobrand'>
                    <div class='prosition_img_to_img'>
                        <img widht='100' height='100' src='../model/picture/Apple-Logo.png'/>
                        <img widht='100' height='100' src='../model/picture/Acer-Logo.png'/>
                        <img widht='100' height='100' src='../model/picture/Asus-Logo.png'/>
                        <img widht='100' height='100' src='../model/picture/HP_New_Logo_2D.svg.png'/>
                        <img widht='100' height='100' src='../model/picture/Lenovo-Logo-1.png'/>
                        <img widht='100' height='100' src='../model/picture/png-transparent-msi-logo-horizontal.png'/>
                    </div>
                </div>
            </div>
        </body>
        ";
        echo "<hr/>";
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
    }else{
    echo "Error: " . $conn->error;
    }
    // session_destroy();
    $conn->close();
?>