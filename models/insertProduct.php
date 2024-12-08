<?php
session_start();
include "adminFunctions.php";
include "../config/conn.php";


if (isset($_POST['addProd'])) {
    global $conn;
    $name = $_POST['prodName'];
    $price = $_POST['price'];
    $image = $_FILES['input-image'];
    $desc = $_POST['description'];
    $cat = $_POST['category'];
    $br = $_POST['brand'];

    $allowed = ['image/png', 'image/jpg', 'image/jpeg'];
    $maxSize = 2500000;

    $type = $image['type'];
    $size = $image['size'];

    if (!in_array($type, $allowed)) {
        setFlash("error", "image", "This type is not allowed.");
    }

    if ($size > $maxSize) {
        setFlash("error", "image", "Your file exceeded maximum size.");
    }

    if (!isset($_SESSION['error']['image'])) {
        $imgExtension = pathinfo($image["name"], PATHINFO_EXTENSION);

        $imageSrc = uniqid() . "_" . $_SESSION['user']->first_name . '.' . $imgExtension;

        if (move_uploaded_file($image['tmp_name'], "../assets/img/shop/" . $imageSrc)) {
            $columns = "product_name, price, description, category_id, brand_id";
            $values = ":p, :pr, :d, :c, :b";
            $params = [":p" => $name, ":pr" => $price, ":d" => $desc, ":c" => $cat, ":b" => $br];

            

            $id=adminInsert("product", $columns, $values, $params);

            $imgCols="path, product_id";
            $imgVals=":p, :pid";
            $imgParams=[":p"=>$imageSrc, ":pid"=>$id];

            adminInsert("image", $imgCols, $imgVals, $imgParams);

            header("Location: ../index.php?page=admin");

        }
    }else{
        echo getFlash("error", "image");
    }
}