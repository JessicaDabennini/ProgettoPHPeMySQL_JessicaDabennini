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

$stmt = $orders->getTotalCo2Saved();
echo "Total CO2 saved: " . $orders->getTotalCo2Saved() . "Kg";

?>
