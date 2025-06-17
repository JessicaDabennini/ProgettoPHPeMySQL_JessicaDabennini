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

// Ottieni i parametri di filtro dalla richiesta GET
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : null;
$country = isset($_GET['country']) ? $_GET['country'] : null;
$product = isset($_GET['product']) ? $_GET['product'] : null;

// Esegui la query con i filtri
$stmt = $orders->tableJoin($startDate, $endDate, $country, $product);

$response = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $response[] = [
        "sales_date" => $row['sales_date'],
        "product_name" => $row['product_name'],
        "destination_country" => $row['destination_country'],
        "quantity" => $row['quantity'],
        "total_co2_saved" => $row['total_co2_saved'] . " Kg"
    ];
}

// Restituisci la risposta in formato JSON
echo json_encode($response);

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: GET");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// // Includi i file di configurazione e modelli
// include_once '../config/database.php';
// include_once '../models/product.php';
// include_once '../models/orders.php';

// // Crea una connessione al database
// $database = new Database();
// $db = $database->getConnection();

// $orders = new Orders($db);
// $stmt = $orders->tableJoin();
// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     // Puoi accedere ai dati come $row['sales_date'], $row['product_name'], ecc.
//     echo "Date: " . $row['sales_date'] . ", Product: " . $row['product_name'] .
//      ", Country: " . $row['destination_country'] . ", Quantity: " . $row['quantity'].
//      ", Total CO2 saved: ".$row['total_co2_saved']. "Kg" . "\n";
// }


?>
