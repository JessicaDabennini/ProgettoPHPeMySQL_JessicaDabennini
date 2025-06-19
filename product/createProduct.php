<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

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

$productResponse = createProduct($data, $product);
http_response_code($productResponse['status']);
echo json_encode($productResponse);

?>
