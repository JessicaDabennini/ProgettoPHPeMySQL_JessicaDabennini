<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:  DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/orders.php';
include_once '../models/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product->id = $data->id;



if($product->delete()){
    http_response_code(200);
    echo json_encode(array("risposta" => "Il product è stato eliminato"));
}else{
    http_response_code(503);
    echo json_encode(array("risposta" => "Impossibile eliminare il product."));
}

?>