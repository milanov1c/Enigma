<?php
    include "functions.php";

if (isPost()) {
    include "../config/conn.php";
    include "products.php";

    global $conn;
    $num=productsNum();

    $categories=$_POST['categories']??0;
    $brands=$_POST['brands']??0;
    $search=$_POST['search']??'';
    $sort=$_POST['sort']??'';
    $page=$_POST['page']??1;
    $perPage=9;
    $offset=($page-1)*$perPage;

    $query="SELECT p.product_id, description, path, price, sale, product_name FROM product p JOIN image i ON p.product_id=i.product_id LEFT JOIN sale s ON p.product_id=s.product_id WHERE i.is_main=1 AND p.is_deleted=0";

    if($categories){
        $query.=" AND p.category_id IN ('".implode("','",
        $categories)."')";
    }
    if($brands){
        $query.=" AND p.brand_id IN ('".implode("','",
        $brands)."')";
    }
    if($search){
        $query.=" AND product_name LIKE :search";
        $search="%$search%";
    }
    if($sort){
        $query.=" ORDER BY $sort";
    }

    $query.=" LIMIT $perPage";

    $query.=" OFFSET $offset";

    $filter=$conn->prepare($query);


    if($search){
        $filter->bindParam(":search", $search);
    }

    $filter->execute();

    $result=$filter->fetchAll();

    if(!empty($result)){
        echo json_encode($result);
        http_response_code(200);
    }else{
        echo json_encode(array());
        http_response_code(204);
    }

} else {
    header("Location: ../index.php?page=404");
}
