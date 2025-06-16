<?php
// Impostazione degli header HTTP
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Inclusione dei file necessari
include_once '../config/database.php';
include_once '../models/product.php';
// include_once '../models/orders.php';

// Creazione dell'oggetto Database e connessione al database
$database = new Database();
$db = $database->getConnection();

// Creazione degli oggetti
$product = new Product($db);
// $order = new Orders($db);

// Recupero dei dati inviati con il POST
$data = json_decode(file_get_contents("php://input"));

// Funzione per creare un prodotto
function createProduct($data, $product) {
    if(!empty($data->product_name) && !empty($data->co2_saved)) {
        $product->product_name = $data->product_name;
        $product->co2_saved = $data->co2_saved;

        if($product->createProduct()) {
            return array("status" => 201, "message" => "Product creato correttamente.");
        } else {
            return array("status" => 503, "message" => "Impossibile creare il product.");
        }
    } else {
        return array("status" => 400, "message" => "Impossibile creare il product, dati incompleti.");
    }
}

// Funzione per creare un ordine
// function createOrder($data, $order) {
//     if(!empty($data->sales_date) && !empty($data->destination_country) && !empty($data->product_id) && !empty($data->quantity)) {
//         $order->sales_date = $data->sales_date;
//         $order->destination_country = $data->destination_country;
//         $order->product_id = $data->product_id;
//         $order->quantity = $data->quantity;

//         if($order->create()) {
//             return array("status" => 201, "message" => "Order creato correttamente.");
//         } else {
//             return array("status" => 503, "message" => "Impossibile creare il order.");
//         }
//     } else {
//         return array("status" => 400, "message" => "Impossibile creare il order, dati incompleti.");
//     }
// }

// Creazione del prodotto
$productResponse = createProduct($data, $product);
http_response_code($productResponse['status']);
echo json_encode($productResponse);

// Creazione dell'ordine
// $orderResponse = createOrder($data, $order);
// http_response_code($orderResponse['status']);
// echo json_encode($orderResponse);
?>
