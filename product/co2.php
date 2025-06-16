<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Includi i file di configurazione e modelli
include_once '../config/database.php';
include_once '../models/product.php';
include_once '../models/orders.php';

// Crea una connessione al database
$database = new Database();
$db = $database->getConnection();

$orders = new Orders($db);
$stmt = $orders->tableJoin();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Puoi accedere ai dati come $row['sales_date'], $row['product_name'], ecc.
    echo "Date: " . $row['sales_date'] . ", Product: " . $row['product_name'] .
     ", Country: " . $row['destination_country'] . ", Quantity: " . $row['quantity'].
     ", Total CO2 saved: ".$row['total_co2_saved']. "Kg" . "\n";
}

?>
