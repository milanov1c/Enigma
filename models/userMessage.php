<?php
session_start();
include "functions.php";


if(isset($_POST['submit'])){
    include "../config/conn.php";

    $subject=post("subject");
    $category=post("category");
    $message=post("message");
    $user=currentUser()->user_id;

    if(empty($subject)){
        setFlash("error", "subject", "Subject is required.");
    }
    if($category==0){
        setFlash("error", "category", "Category is required.");
    }
    if(empty($message)){
        setFlash("error", "message", "Message is required.");
    }
    if(!isLogged()){
        setFlash("error", "login", "In order to send a message you must log in.");
    }

    if(empty($_SESSION['error'])){
        $query="INSERT INTO message (category_id, subject, user_id, message) VALUES(:c, :s, :u, :m)";

        $stmt=$conn->prepare($query);
        $res=$stmt->execute([":c"=>$category, ":s"=>$subject, ":u"=>$user, ":m"=>$message]);

        if($res){
            setFlash("success", "form", "Your message has been sent.");
            header("Location: ../index.php?page=contact");
        }else{
            setFlash("error", "form", "An error occured. Please try again.");
            header("Location: ../index.php?page=contact");
        }
    }

}else{
    header("Location: ../index.php?page=404");
}