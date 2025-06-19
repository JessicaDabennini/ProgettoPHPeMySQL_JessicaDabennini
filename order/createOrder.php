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

function createOrder($data, $order) {
    if(!empty($data->sales_date) && !empty($data->destination_country) && !empty($data->product_id) && !empty($data->quantity)) {

        $order->sales_date = $data->sales_date;
        $order->destination_country = $data->destination_country;
        $order->product_id = $data->product_id;
        $order->quantity = $data->quantity;

        if($order->createOrder()) {
            return array("status" => 201, "message" => "Order creato correttamente.");
        } else {
            return array("status" => 503, "message" => "Impossibile creare il order.");
        }
    } else {
        return array("status" => 400, "message" => "Impossibile creare il order, dati incompleti.");
    }
}

$orderResponse = createOrder($data, $order);
http_response_code($orderResponse['status']);
echo json_encode($orderResponse);
?>
