<?php
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
function adminInsert($table, $columns, $values, $params){
    global $conn;

    $query="INSERT INTO $table ($columns) VALUES ($values)";

    $stmt=$conn->prepare($query);

    $res=$stmt->execute($params);

    if($res){
        setFlash("success", "insert", "Your insert was successfull.");
    }

    return $conn->lastInsertId();
}

function adminDelete($table, $id){
    global $conn;

    $query="UPDATE $table SET is_deleted=1 WHERE ".$table."_id=:id";

    $stmt=$conn->prepare($query);

    $res=$stmt->execute([":id"=>$id]);

    if($res){
        setFlash("success", "delete", "Your deletion was successfull");
    }
}