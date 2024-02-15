<?php
include "../../connect_db/connect_sql.php";

session_start();
$custID = $_SESSION['custID'];

$query = "  SELECT * FROM hearder as h
            JOIN detail as d ON h.hearID = d.hearID
            JOIN product as pr ON d.prodID = pr.prodID
            WHERE h.custID='$custID' AND h.status <>'ปิดการขาย'";

$result = $conn->query($query);
 
echo "$result";

// $result = $conn->query($query);
// $heardID = $row['hearID'];
// $prodName = $row['prodName'];
// $quantity = $row['quantity'];
// $totalPrice = $row['totalprice'];
// $status = $row['status'];

if($result){
    require '../controlbar/Navbarcustomer.html';
    echo "
        <style>
            .container {
                max-width: 600px; /* Adjust the width as needed */
                margin: 0 auto; /* This will center the container */
                padding: 20px;
            }

            .order-card {
                background: #fff;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 20px;
                margin-bottom: 20px;
                /* Remove any width or flex properties that were previously here */
            }
            .order-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
            .order-content {
                border-top: 1px solid #ddd;
                padding-top: 15px;
            }
            .product-item {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
            }
            .product-name {
                font-weight: bold;
            }
            .product-quantity {
                margin-left: 10px;
            }
            .product-price {
                color: #5cb85c;
            }
            .repurchase-btn {
                background-color: #007bff;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 4px;
                display: inline-block;
            }
            .repurchase-btn:hover {
                background-color: #0056b3;
            }
            .order-status {
                font-weight: bold;
                color: #007bff;
            }         
        </style>";
    
    while ($data = $result->fetch_assoc()) {
        $heardID = $data['hearID'];
        $prodName = $data['prodName'];
        $quantity = $data['quantity'];
        $totalPrice = $data['totalprice'];
        $status = $data['status'];
        echo "$heardID, $prodName, $quantity , $totalPrice, $status  ";

        echo "
            <div class=container>
                <div class=order-card>
                    <div class=order-header>
                        <span>Order ID:$heardID</span>
                        <span class=order-status>Status: $status</span>
                    </div>
                    <div class=order-content>
                        <!-- Repeat this section for each product in the order -->
                        <div class=product-item>
                            <span class=product-name>$prodName</span>
                            <span class=product-quantity>Qty: $quantity</span>
                            <span class=product-price>$totalPrice</span>
                        </div>
                        <!-- End Product Item -->
                    </div>
                    <a href=repurchase-link class=repurchase-btn>Repurchase</a>
                </div>
            </div>
            ";
    }
    require '../controlbar/footer.html';
}else{
    echo "Error: " . mysqli_error($conn);
}
$conn->close();
?>