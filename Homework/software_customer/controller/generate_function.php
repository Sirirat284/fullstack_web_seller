<?php
include "../../connect_db/connect_sql.php";
session_start();
$custID = $_SESSION['custID'];

class generate_class {
    private $conn;

    public function __construct() {
        // Assuming $conn from connect_sql.php is global. If not, use your own connection details.
        global $conn;
        $this->conn = $conn;
    }

    public function generate_header($custID, $customer_name, $shipping_name, $payment_name, $tax, $shipping_address, $phone_number, $status) {
        $stmt = $this->conn->prepare("INSERT INTO hearder (custID, customer_name, shipping_name, payment_name, shipping_address, phone_number, status, TaxID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssss", $custID, $customer_name, $shipping_name, $payment_name, $shipping_address, $phone_number, $status, $tax);

        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }

    public function get_headID() {
        // Assuming 'hearID' is intended to be auto-increment and you want the latest entry
        $query = "SELECT * FROM hearder ORDER BY hearID DESC LIMIT 1;"; // Correct table name and query
        $result = $this->conn->query($query); // Use $this->conn to access the connection
    
        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $header_ID = $data['hearID'];
            return $header_ID; // Return the latest hearID
        } else {
            // Return error information or false
            return false; // Indicate failure
        }
    }
    private function insert_detail($hearID, $prodID, $quantity, $totalprice) {
        $stmt = $this->conn->prepare("INSERT INTO detail (hearID, prodID, quantity, totalprice) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $hearID, $prodID, $quantity, $totalprice); // Note: Assuming 'quantity' and 'totalprice' are integers

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    private function delete_basket($custID){
        $stmt = $this->conn->prepare("DELETE FROM basket WHERE custID = ?");
        $stmt->bind_param("s",$custID);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
    public function generate_detail($headID, $custID) { // Added $custID as parameter
        $query = "SELECT * FROM basket INNER JOIN product ON basket.prodID = product.prodID WHERE custID=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $custID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            while ($data = $result->fetch_assoc()) {
                $prodID = $data['prodID'];
                $price = $data['price'];
                $quantity = $data['quantity'];
                $totalprice = $quantity * $price;

                $result_insert = $this->insert_detail($headID, $prodID, $quantity, $totalprice);
                if (!$result_insert) {
                    echo "Error inserting detail: " . $this->conn->error;
                    return false; // Stop further processing on error
                }
            }
            $result_delete = $this->delete_basket($custID);
            if (!$result_delete) {
                echo "Error inserting delete: " . $this->conn->error;
                return false; // Stop further processing on error
            }
            return true; // Successfully processed all items
        } else {
            echo "Error fetching basket data: " . $this->conn->error;
            return false;
        }

    }

    

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}