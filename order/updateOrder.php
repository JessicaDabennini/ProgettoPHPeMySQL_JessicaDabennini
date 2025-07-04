<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/orders.php';

$database = new Database();
$db = $database->getConnection();

$order = new Orders($db);

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    $order->id = $data->id; 
    $order->sales_date = $data->sales_date;
    $order->destination_country = $data->destination_country;
    $order->product_id = $data->product_id;
    $order->quantity = $data->quantity;

    if ($order->updateOrder()) {
        $response["order_message"] = "Order aggiornato";
        http_response_code(200);
    } else {
        $response["order_message"] = "Impossibile aggiornare il order";
        http_response_code(503);
    }
    echo json_encode($response);
} else {
    http_response_code(400);
    echo json_encode(array("error" => "ID not provided"));
}

?>