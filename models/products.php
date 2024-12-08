<?php

function getProducts(){
    global $conn;

    $query = "SELECT * FROM product p JOIN brand b ON p.brand_id=b.brand_id JOIN category c ON p.category_id=c.category_id JOIN image i ON p.product_id=i.product_id JOIN sale s ON p.product_id=s.product_id WHERE i.is_main=1 AND p.is_deleted=0 LIMIT 9";

    $select = $conn->query($query);

    return $select->fetchAll();

}

function getAllProducts(){
    global $conn;

    $query = "SELECT * FROM product p JOIN brand b ON p.brand_id=b.brand_id JOIN category c ON p.category_id=c.category_id JOIN image i ON p.product_id=i.product_id JOIN sale s ON p.product_id=s.product_id WHERE i.is_main=1";

    $select = $conn->query($query);

    return $select->fetchAll();
}

function getBrands(){
    global $conn;

    $query = "SELECT b.brand_id, b.brand_name, COUNT(p.product_id) AS num FROM product p JOIN brand b ON p.brand_id=b.brand_id GROUP BY b.brand_name";

    $select = $conn->query($query);

    return $select->fetchAll();
}

function getCategories(){
    global $conn;

    $query = "SELECT c.category_id, c.category_name, COUNT(p.product_id) AS num FROM product p JOIN category c ON p.category_id=c.category_id GROUP BY c.category_name";

    $select = $conn->query($query);

    return $select->fetchAll();
}

function getProductBy($id){
    global $conn;

    $query="SELECT * FROM product p JOIN brand b ON p.brand_id=b.brand_id JOIN category c ON p.category_id=c.category_id JOIN image i ON p.product_id=i.product_id WHERE p.is_deleted=0 AND p.product_id=:id";

    $stmt=$conn->prepare($query);

    $stmt->bindParam(":id",$id);
    $stmt->execute();
    $result=$stmt->fetch();
    return $result;
}

function getProductsLimit($offset, $limit){
    global $conn;

    $query = "SELECT * FROM product p JOIN brand b ON p.brand_id=b.brand_id JOIN category c ON p.category_id=c.category_id JOIN image i ON p.product_id=i.product_id WHERE i.is_main=1 AND p.is_deleted=0 LIMIT $limit OFFSET $offset";

    $select = $conn->query($query);

    return $select->fetchAll();
}

function getSale($id){
    global $conn;

    $currentDate=time();

    $query="SELECT sale, s.product_id, p.product_id, date_from, date_to FROM sale s JOIN product p ON s.product_id=p.product_id WHERE p.product_id=:id";

    $stmt=$conn->prepare($query);

    $stmt->bindParam(":id",$id);

    $stmt->execute();

    $result=$stmt->fetch();

    if($result){
        $dateFrom=strtotime($result->date_from);

        $dateTo=strtotime($result->date_to);
    
        
    
        if($currentDate>$dateFrom && $currentDate<$dateTo){
            return $result->sale;
        }
        return false;
    }

}

function productsNum(){
    global $conn;
    
    $query="SELECT COUNT(*) as num FROM product";

    $select=$conn->query($query);

    $result=$select->fetch();
    
    return $result->num;
}