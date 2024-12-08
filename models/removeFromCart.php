<?php
header("Content-type: application/json");
session_start();
include "../config/conn.php";
include "functions.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user']) && isset($_POST['product'])) {
        $user = $_SESSION['user']->user_id;
        $product_id = $_POST['product'];

        try {
            $conn->beginTransaction();

            $query = "DELETE FROM cart_item WHERE product_id = :id AND user_id = :usr";
            $stmt = $conn->prepare($query);
            $stmt->execute([":id" => $product_id, ":usr" => $user]);

            $rest = getCartProducts($user);

            $conn->commit();

            echo json_encode($rest);
            http_response_code(200);
        } catch (Exception $e) {
            $conn->rollBack();
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Invalid request"]);
    }
} else {
    header("Location: ../index.php?page=404");
}
