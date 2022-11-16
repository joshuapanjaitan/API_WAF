<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new Product($db);
 
// set ID property of product to be edited
$product->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$product->readOne();
// create array
$product_arr = array(
    //"state" => $product->state,
    "id" =>  $product->id,
    "name" => $product->name,
    "description" => $product->description,
    "price" => $product->price,
    "category_id" => $product->category_id,
    "category_name" => $product->category_name
 
);

if ($product->state == "true"){
    $ress = array(
        "success" => $product->state,
        "payload" => $product_arr,
    );
}else{
    $ress = array(
        "success" =>'false',
        "payload" => "Data not Found",
    );
}

 
// make it json format
// return
print_r(json_encode($ress));
?>