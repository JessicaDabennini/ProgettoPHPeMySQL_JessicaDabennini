<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $product_name;
    public $co2_saved;
    public $id;

    public function __construct($db) {
        $this->conn = $db;
    }

    function readProduct() {
        $query = "SELECT product_name, co2_saved FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function createProduct() {
        $query = "INSERT INTO " . $this->table_name . " SET product_name = :product_name, co2_saved = :co2_saved";
        $stmt = $this->conn->prepare($query);

        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->co2_saved = htmlspecialchars(strip_tags($this->co2_saved));

        $stmt->bindParam(":product_name", $this->product_name);
        $stmt->bindParam(":co2_saved", $this->co2_saved);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    function updateProduct() {

    $query = "UPDATE products SET product_name = :product_name, co2_saved = :co2_saved WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":product_name", $this->product_name);
    $stmt->bindParam(":co2_saved", $this->co2_saved);
    $stmt->bindParam(":id", $this->id);
    $stmt->execute();

    return false;
    }


        function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

}

?>