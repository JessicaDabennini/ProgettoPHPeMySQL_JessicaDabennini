<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/orders.php';
include_once '../models/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));
var_dump($data); // Aggiungi questa riga per il debug


if (isset($data->id)) {
    $product->id = $data->id;
    $product->product_name = $data->product_name;
    $product->co2_saved = $data->co2_saved;

    try {
        if ($product->updateProduct()) {
            http_response_code(200);
            echo json_encode(array("risposta" => "Product aggiornato"));
        } else {
            http_response_code(503);
            echo json_encode(array("risposta" => "Impossibile aggiornare il product"));
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(array("risposta" => "Errore: " . $e->getMessage()));
    }
} else {
    http_response_code(400);
    echo json_encode(array("risposta" => "ID del prodotto non fornito"));
}


// Update product if product_id is provided
// if (isset($data->id)) {
//     $product->id = $data->id; // Assuming 'product_id' is the identifier for the product
//     $product->product_name = $data->product_name;
//     $product->co2_saved = $data->co2_saved;

//     if ($order->updateOrder()) {
//         $response["product_message"] = "Order aggiornato";
//     } else {
//         $response["product_message"] = "Impossibile aggiornare il order";
// }}

// if ($product->updateProduct()) {
//         http_response_code(200);
//         echo json_encode(array("risposta" => "Product aggiornato"));
//     } else {
//         http_response_code(503);
//         echo json_encode(array("risposta" => "Impossibile aggiornare il product"));
//     }
?>

