<?php
class Product {
    private $conn;
    private $table_name = "products";

    // Proprietà di un libro
    public $product_name;
    public $co2_saved;
    public $id;

    // Costruttore
    public function __construct($db) {
        $this->conn = $db;
    }

    // Metodo per leggere i libri dal database
    function readProduct() {
        $query = "SELECT product_name, co2_saved FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function createProduct() {
        $query = "INSERT INTO " . $this->table_name . " SET product_name = :product_name, co2_saved = :co2_saved";
        $stmt = $this->conn->prepare($query);

        // Sanitizzazione degli input
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->co2_saved = htmlspecialchars(strip_tags($this->co2_saved));

        // Binding dei parametri
        $stmt->bindParam(":product_name", $this->product_name);
        $stmt->bindParam(":co2_saved", $this->co2_saved);

        // Esecuzione della query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    function updateProduct() {
// Update product
    $query = "UPDATE products SET product_name = :product_name, co2_saved = :co2_saved WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":product_name", $this->product_name);
    $stmt->bindParam(":co2_saved", $this->co2_saved);
    $stmt->bindParam(":id", $this->id);
    $stmt->execute();

    return false;
    }

    // Metodo per cancellare un libro

        function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitizzazione dell'input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binding del parametro
        $stmt->bindParam(1, $this->id);

        // Esecuzione della query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

}

?>