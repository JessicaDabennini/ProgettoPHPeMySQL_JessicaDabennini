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


// Esecuzione della query per leggere i product
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


// $stmt_orders = $order->read();
// $num_orders = $stmt_orders->rowCount();

// if($num_orders > 0) {
//     $orders_arr = array();
//     $orders_arr["list"] = array();

//     while ($row_orders = $stmt_orders->fetch(PDO::FETCH_ASSOC)) {
//         extract($row_orders);
//         $orders_item = array(
//             "sales_date" => $sales_date,
//             "destination_country" => $destination_country,
//             "product_id" => $product_id,
//             "quantity" => $quantity
//         );
//         array_push($orders_arr["list"], $orders_item);
//     }
// }

echo json_encode(array("products" => $product_arr));
?>