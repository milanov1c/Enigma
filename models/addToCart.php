<?php
session_start();
include "functions.php";
header("Content-type: application/json");
if(isPost()){
    include "../config/conn.php";
    
    $user=$_SESSION['user']->user_id;
    $product=post("product");
    $quantity=post("quantity");

    $query="INSERT INTO cart_item(user_id, product_id, quantity) VALUES(:user, :prod, :quantity)";

    $stmt=$conn->prepare($query);
    $stmt->execute(['user'=>$user, 'prod'=>$product,'quantity'=>$quantity]);

    

    echo json_encode("Product has been added to your cart.");
}else{
    header("Location: index.php?page=404");
}