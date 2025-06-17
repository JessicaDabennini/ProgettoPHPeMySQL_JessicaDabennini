<?php
class Orders {
    private $conn;
    private $table_name = "orders";

    // Proprietà di un libro
    public $sales_date;
    public $destination_country;
    public $product_id;
    public $quantity;
    public $co2_saved;
    public $product_name;
    public $id;
    public $total_co2_saved;

    // Costruttore
    public function __construct($db) {
        $this->conn = $db;
    }

    // Metodo per leggere i libri dal database
    function read() {
        $query = "SELECT id,sales_date, destination_country, product_id, quantity FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Metodo per creare un nuovo libro
    function createOrder() {
        $query = "INSERT INTO " . $this->table_name . " SET sales_date = :sales_date, destination_country = :destination_country, product_id = :product_id, quantity = :quantity";
        $stmt = $this->conn->prepare($query);

        // Sanitizzazione degli input
        // $this->id = htmlspecialchars(strip_tags($this->id));
        $this->sales_date = htmlspecialchars(strip_tags($this->sales_date));
        $this->destination_country = htmlspecialchars(strip_tags($this->destination_country));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));

        // Binding dei parametri
        // $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":sales_date", $this->sales_date);
        $stmt->bindParam(":destination_country", $this->destination_country);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":quantity", $this->quantity);

        // Esecuzione della query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Metodo per aggiornare un libro esistente
    // function update() {
    //     $query = "UPDATE " . $this->table_name . " SET sales_date = :sales_date, destination_country = :destination_country WHERE product_id = :product_id";
    //     $stmt = $this->conn->prepare($query);

    //     // Sanitizzazione degli input
    //     $this->sales_date = htmlspecialchars(strip_tags($this->sales_date));
    //     $this->destination_country = htmlspecialchars(strip_tags($this->destination_country));
    //     $this->product_id = htmlspecialchars(strip_tags($this->product_id));
    //     $this->quantity = htmlspecialchars(strip_tags($this->quantity));


        

    //     // Binding dei parametri
    //     $stmt->bindParam(":sales_date", $this->sales_date);
    //     $stmt->bindParam(":destination_country", $this->destination_country);
    //     $stmt->bindParam(":product_id", $this->product_id);
    //     $stmt->bindParam(":quantity", $this->quantity);


    //     // Esecuzione della query
    //     if($stmt->execute()) {
    //         return true;
    //     }

    //     return false;
    // }

    function updateOrder() {
    // Update order
    $query = "UPDATE orders SET sales_date = :sales_date, destination_country = :destination_country, product_id = :product_id, quantity = :quantity WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":sales_date", $this->sales_date);
    $stmt->bindParam(":destination_country", $this->destination_country);
    $stmt->bindParam(":product_id", $this->product_id);
    $stmt->bindParam(":quantity", $this->quantity);
    $stmt->bindParam(":id", $this->id);
    $stmt->execute();

}

    
//     function updateProduct() {
// // Update product
//     $query = "UPDATE products SET product_name = :product_name, co2_saved = :co2_saved WHERE id = :id";
//     $stmt = $this->conn->prepare($query);
//     $stmt->bindParam(":product_name", $this->product_name);
//     $stmt->bindParam(":co2_saved", $this->co2_saved);
//     $stmt->bindParam(":id", $this->id);
//     $stmt->execute();

//     return true;
//     }

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


    // function tableJoin() {
    //     $query = "
    //         SELECT 
    //             o.sales_date, 
    //             o.destination_country, 
    //             o.product_id, 
    //             (o.quantity * p.co2_saved) AS total_co2_saved, 
    //             o.quantity, 
    //             p.product_name, 
    //             p.co2_saved,
    //         FROM 
    //             " . $this->table_name . " o
    //         JOIN 
    //             products p ON o.product_id = p.id
    //     ";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     return $stmt;
    // }

    public function tableJoin($startDate, $endDate, $country, $product) {
    $query = "SELECT     o.sales_date,
               o.destination_country,
                 o.product_id,
                 o.quantity,
                 (o.quantity * p.co2_saved) AS total_co2_saved,
                 p.product_name
            FROM orders o JOIN products p ON o.product_id = p.id WHERE 1=1";

    if ($startDate) {
        $query .= " AND o.sales_date >= :start_date";
    }
    if ($endDate) {
        $query .= " AND o.sales_date <= :end_date";
    }
    if ($country) {
        $query .= " AND o.destination_country = :country";
    }
    if ($product) {
        $query .= " AND p.product_name = :product";
    }

    $stmt = $this->conn->prepare($query);

    if ($startDate) {
        $stmt->bindParam(':start_date', $startDate);
    }
    if ($endDate) {
        $stmt->bindParam(':end_date', $endDate);
    }
    if ($country) {
        $stmt->bindParam(':country', $country);
    }
    if ($product) {
        $stmt->bindParam(':product', $product);
    }

    $stmt->execute();
    return $stmt;
}

// function tableJoin() {
//         $query = "
//             SELECT
//                 o.sales_date,
//                 o.destination_country,
//                 o.product_id,
//                 o.quantity,
//                 (o.quantity * p.co2_saved) AS total_co2_saved,
//                 p.product_name
//             FROM
//                 " . $this->table_name . " o
//             JOIN
//                 products p ON o.product_id = p.id
//         ";
//         $stmt = $this->conn->prepare($query);
//          if ($stmt) { // Check if prepare was successful
//             if ($stmt->execute()) {
//                 return $stmt;
//             } else {
//                 error_log("Error executing query: " . print_r($stmt->errorInfo(), true)); // Log the error
//                 return false; // Or throw an exception
//             }
//         } else {
//             error_log("Error preparing query: " . print_r($this->conn->errorInfo(), true));
//             return false; // Or throw an exception
//         }
//     }
    
    public function getTotalCo2Saved() {
        $query = "
            SELECT SUM(o.quantity * p.co2_saved) AS Co2_GrandTotal
            FROM " . $this->table_name . " o
            JOIN products p ON o.product_id = p.id";

        $stmt = $this->conn->prepare($query);

        if ($stmt) { // Check if prepare was successful
            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC); // Use PDO::FETCH_ASSOC
                return $result['Co2_GrandTotal'];
            } else {
                error_log("Error executing query: " . print_r($stmt->errorInfo(), true));
                return false; // Or throw an exception
            }
        } else {
            error_log("Error preparing query: " . print_r($this->conn->errorInfo(), true));
            return false; // Or throw an exception
        }
    }
}
?>



