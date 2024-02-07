<?php
include "../../connect_db/connect_sql.php";

// Prepare and execute the query
$query = "SELECT * FROM product ";
$result = $conn->query($query);

if($result){
    require 'Navbaradmin.html';
    echo "  <title>ข้อมูลสินค้า</title>";
    echo "  <style>
                .insert-section {
                    display: flex;
                    justify-content: space-between;
                    padding: 1px ;
                }
                .customer-data {
                    font-size: 20px;
                    margin-left: 50px;
                    color: #333; /* Dark grey color */
                }
                .insert-button {
                    display: block;
                    text-align: right; /* Align button to the right */
                    padding: 10px ;
                    margin-right: 50px;
                }

                .insert-button a {
                    background-color: #4CAF50; /* Green background */
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 5px; /* Rounded corners */
                    transition: background-color 0.3s; /* Smooth transition for background */
                }

                .insert-button a:hover {
                    background-color: #45a049; /* Darker green on hover */
                }
                table {
                    width: 1200px;
                    border-collapse: collapse;
                    margin: auto;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                th {
                    background-color: #58D68D;
                    color: white;
                    padding: 10px;
                }
                td {
                    padding: 10px;
                    text-align: center;
                    border-bottom: 1px solid #ddd;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
            </style>";
    echo '  <div class="insert-section">
                <div class="customer-data">ข้อมูลสินค้า</div>
                <div class="insert-button">
                    <a href="insertproduct.html">Insert</a>
                </div>
            </div>';
    echo "<br>";
    echo "<table>
    <tr>
        <th width='50px'>No</th>
        <th width='50px'>ID</th>
        <th width='350px'>photo</th>
        <th width='150px'>Name</th>
        <th width='80px'>Type</th>
        <th width='100px'>Brand</th>
        <th width='500px'>Detail</th>
        <th width='50px'>amount</th>
        <th width='100px'>price</th>
        <th width='20px'></th>
        <th width='20px'></th>
    </tr>";
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
        echo "<tr>
        <td>$count</td>
        <td>$prodID</td>
        <td><img width=300 height=300 src='../model/photo/$pathphoto'/></td>
        <td>$prodName</td>
        <td>$prodType</td>
        <td>$brand</td>
        <td>$detail</td>
        <td>$amount</td>
        <td>$price</td>
        <td>
            <form method=get action=../view/editproduct.php>
                <input type= Hidden name = prodID value=$prodID>
                <button type=submit style =' border: none; background: none; padding: 0; margin: 0; cursor: pointer;' alt=edit ><img width=20 height=20 src=https://img.icons8.com/cute-clipart/64/edit.png></botton>
            </form>
        </td>
        <td>
            <form method=post action= ../controller/delete_product.php>
                <input type= Hidden name = prodID value=$prodID>
                <button type=submit style =' border: none; background: none; padding: 0; margin: 0; cursor: pointer;' alt=delete ><img width=20 height=20 src=https://img.icons8.com/plasticine/100/filled-trash.png /></botton>
            </form>
        </td>
    </tr>";
    }

}
else{
    echo "Error: " . $conn->error;
}

$conn->close();
?>