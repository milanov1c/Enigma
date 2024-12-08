<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



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

function getAll($table)
{
    global $conn;

    $query = 'SELECT * FROM ' . $table;

    $select = $conn->query($query)->fetchAll();

    return $select;
}

function post($key)
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return null;
}

function get($key)
{
    if (isset($_GET[$key])) {
        return $_GET[$key];
    }
    return null;
}

function isPost()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function isGet()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function isLogged()
{
    return isset($_SESSION['user']);
}

function currentUser()
{
    if (isLogged()) {
        return $_SESSION['user'];
    }
    return null;
}



function getUserById($id)
{
    global $conn;

    $query = "SELECT * FROM user WHERE user_id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetch();

}

function getUserBy($table, $value)
{
    global $conn;

    if ($table == "username") {
        $query = "SELECT COUNT(*) AS n FROM user WHERE username=:value";
    }
    if ($table == "email") {
        $query = "SELECT COUNT(*) AS n FROM user WHERE email=:value";
    }

    $select = $conn->prepare($query);
    $select->bindParam(":value", $value);

    $select->execute();

    $result = $select->fetch();
    return $result;
}

function validateInput($input, $regex, $error, $key)
{

    if (!preg_match($regex, $input)) {
        setFlash("error", $key, $error);
    }
}

function registerUser($name, $surname, $email, $password, $username)
{
    global $conn;

    $query = "INSERT INTO user(first_name, last_name, email, password, username) VALUES(:name, :surname, :email, :password, :username)";

    $stmt = $conn->prepare($query);

    $res = $stmt->execute([
        ":name" => $name,
        ":surname" => $surname,
        ":email" => $email,
        ":password" => $password,
        ":username" => $username
    ]);

    $id=$conn->lastInsertId();

    if($res){
        sendMailActivate($email,$id );
    }

    return $res;
}

function loginUser($username, $password)
{
    global $conn;

    $query = "SELECT * FROM user u JOIN role r ON u.role_id=r.role_id WHERE username=:username";

    $select = $conn->prepare($query);
    $select->execute([":username" => $username]);

    $user = $select->fetch();

    if (!$user) {
        setFlash("error", "login", "Your credentials are invalid.");

    } else {
        if (!$user->is_active) {
            setFlash("error", "login", "Your account is not activated. Please check your mail in order to activate your account.");

        } else if ($user->is_disabled) {
            setFlash("error", "login", "Your account is temporarily disabled. Please check your mail in order to activate your account again.");

        } else if ($user->password != $password) {

            setFlash("error", "login", "Your credentials are invalid.");

            failedAttempt($user->user_id);

            if (checkAttempts($user->user_id)) {
                disableAccount($user);
            }
        } else {
            unset($user->password);

            $_SESSION['user'] = $user;

            if ($_SESSION['user']->role_id == 2) {
                include "loginLogger.php";
                header("Location: index.php?page=shop");
                ob_end_flush();
            }else if($_SESSION['user']->role_id==1){
                include "logginLoger.php";
                header("Location: index.php?page=admin");
                ob_end_flush();
            }

        }
    }
}

function getCartProducts($id)
{
    global $conn;

    $query = "SELECT product_name, price, sale, quantity, p.product_id, path FROM cart_item c JOIN product p ON c.product_id=p.product_id LEFT OUTER JOIN sale s ON s.product_id=p.product_id JOIN image i ON i.product_id=p.product_id WHERE user_id=:id";

    $stmt = $conn->prepare($query);

    $stmt->execute([":id" => $id]);

    $result = $stmt->fetchAll();

    return $result;
}

function hasAddress($id)
{
    global $conn;

    $query = "SELECT * FROM address WHERE user_id=$id";

    $select = $conn->query($query);

    $result = $select->fetch();

    return $result;
}

function addOrder($user, $total)
{
    global $conn;

    $query = "INSERT INTO orders (user_id, total) VALUES (:id, :total)";

    $stmt = $conn->prepare($query);

    $stmt->execute([":id" => $user, ":total" => $total]);

    return $conn->lastInsertId();
}

function addOrderItem($product, $order, $quantity, $price)
{
    global $conn;

    $query = "INSERT INTO order_product (product_id, order_id, quantity, price) VALUES (:prod, :ord, :q, :pr)";

    $stmt = $conn->prepare($query);

    $stmt->execute([":prod" => $product, ":ord" => $order, ":q" => $quantity, ":pr" => $price]);

    return $stmt;
}

function deleteCartOrder($cart, $user)
{
    global $conn;

    $query = "DELETE FROM cart_item WHERE product_id=:c AND user_id=:u";

    $stmt = $conn->prepare($query);

    $stmt->execute([":c" => $cart, ":u" => $user]);

    return $stmt;
}

function failedAttempt($user)
{
    global $conn;

    $query = "INSERT INTO login_attempts (user_id) VALUES (:u)";

    $stmt = $conn->prepare($query);

    $stmt->execute([":u" => $user]);
}
function disableAccount($user)
{
    global $conn;

    $query = "UPDATE user SET is_disabled=1 WHERE user_id=:id";

    $stmt = $conn->prepare($query);

    $stmt->execute([":id" => $user->user_id]);

    sendMailEnable($user);

}



function checkAttempts($user)
{
    global $conn;

    $query = "SELECT * FROM login_attempts WHERE user_id=$user ORDER BY login_time DESC LIMIT 3";

    $select = $conn->query($query);

    $result = $select->fetchAll();

    if (count($result) < 3) {
        return false;
    }

    $now = time();
    $fiveMinAgo = $now - 300;

    foreach ($result as $r) {
        if ($r->login_time < $fiveMinAgo) {
            return false;
        }
    }

    return true;
}

function sendMailEnable($user)
{
    include "config/config.php";
    global $baseUrl;
    $mail = new PHPMailer(true);

    try {
        $mail = new PHPMailer();

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

        //Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
        $mail->Port = 465;

        //Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'milanovic.nikolina03@gmail.com';

        //Password to use for SMTP authentication
        $mail->Password = 'hhql ekeb vgta zoqe';

        $mail->setFrom('milanovic.nikolina03@gmail.com', 'Nikolina Milanovic');

        $mail->addAddress($user->email);

        $mail->isHTML(true);

        $mail->Body = "<p>In order to enable your account again click on the link below.</p> <br/> <br/> <br/> <a href='$baseUrl/models/enableAccount.php?id=" . $user->user_id . "'>Enable account</a>";

        $mail->Subject = 'Enabling Account';

        $mail->send();
    } catch (Exception $e) {
        return false;
    }
}

function sendMailActivate($email, $id){
    include "config/config.php";
    global $baseUrl;
    $mail = new PHPMailer(true);

    try {
        $mail = new PHPMailer();

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

        //Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
        $mail->Port = 465;

        //Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'milanovic.nikolina03@gmail.com';

        //Password to use for SMTP authentication
        $mail->Password = 'hhql ekeb vgta zoqe';

        $mail->setFrom('milanovic.nikolina03@gmail.com', 'Nikolina Milanovic');

        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Body = "<p>In order to activate your account click on the link below.</p> <br/> <br/> <br/> <a href='$baseUrl/models/activateAccount.php?id=" . $id . "'>Activate account</a>";

        $mail->Subject = 'Activating Account';

        $mail->send();
    } catch (Exception $e) {
        return false;
    }
}

function getStatistics() {
   

    $lines = file("data/visit.txt");
    $totalRecords = 0;
    $uniqueUsers = [];
    $pageViews = [];

    foreach ($lines as $line) {
        $parts = explode("____", $line);
        if (count($parts) == 5) {
            $totalRecords++;
            $username = $parts[1];
            $page = $parts[2];
            $uniqueUsers[$username] = true;
            $pageViews[$page] = isset($pageViews[$page]) ? $pageViews[$page] + 1 : 1;
        }
    }

    $statistics = [
        'total_records' => $totalRecords,
        'unique_users' => count($uniqueUsers),
        'page_views' => $pageViews
    ];

    return $statistics;
}

function getLoginStatistics() {
  

    $lines = file("data/login.txt");
    $totalAttempts = count($lines);
    $userAttempts = [];

    foreach ($lines as $line) {
        $parts = explode("____", $line);
        if (count($parts) == 3) {
            $username = $parts[1];
            if (!isset($userAttempts[$username])) {
                $userAttempts[$username] = 1;
            } else {
                $userAttempts[$username]++;
            }
        }
    }

    $statistics = [
        'total_attempts' => $totalAttempts,
        'user_attempts' => $userAttempts
    ];

    return $statistics;
}




