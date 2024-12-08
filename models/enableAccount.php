<?php
function getUserById($id)
{
    global $conn;

    $query = "SELECT * FROM user WHERE user_id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetch();

}
function setFlash($type, $key, $value)
{
    $_SESSION[$type][$key] = $value;
}



function getFlash($type, $key)
{
    if (!hasFlash($type, $key)) {
        return null;
    }

    $flashData = $_SESSION[$type][$key];

    unset($_SESSION[$type][$key]);

    return $flashData;
}

function hasFlash($type, $key)
{
    return isset($_SESSION[$type][$key]) && $_SESSION[$type][$key];
}

if (isset($_GET['id'])) {
    include "../config/conn.php";
    $id = $_GET['id'];
    $user = getUserById($id);
    if ($user) {
        try {
            $conn->beginTransaction();

            $update = "UPDATE user SET is_disabled=0 WHERE user_id=:id";

            $stmt = $conn->prepare($update);

            $stmt->execute([":id"=>$id]);

            $delete="DELETE FROM login_attempts WHERE user_id=:id";

            $deleteStmt=$conn->prepare($delete);

            $deleteStmt->execute([":id"=>$id]);

            $conn->commit();

            header("Location: ../index.php?page=login");
        } catch (PDOException $e) {
            $conn->rollBack();
            header("Location: ../index.php?page=404");
        }




    }
} else {
    header("Location: ../index.php?page=404");
}