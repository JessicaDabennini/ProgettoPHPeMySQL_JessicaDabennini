<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/orders.php';
include_once '../models/product.php';

$database = new Database();
$db = $database->getConnection();

if ($db === null) {
    echo json_encode(array("message" => "Database connection failed."));
    exit();
}

$product = new Product($db);
$order = new Orders($db);

$stmt_product = $product->readProduct();
$num_product = $stmt_product->rowCount();

if($num_product > 0) {
    $product_arr = array();
    $product_arr["list"] = array();

    while ($row_product = $stmt_product->fetch(PDO::FETCH_ASSOC)) {
        extract($row_product);
        $product_item = array(
            "product_name" => $product_name,
            "co2_saved" => $co2_saved
        );
        array_push($product_arr["list"], $product_item);
    }
}

echo json_encode(array("products" => $product_arr));
?>