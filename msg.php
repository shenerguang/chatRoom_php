<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 15/7/10
 * Time: 上午10:27
 */
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$pdo = new PDO('mysql:host=127.0.0.1;dbname=phpMessage', 'root', '123456');
$msgToInput = $_POST["msgA"];
unset($_POST["msgA"]);
if(isset($_SESSION["user"]) && $msgToInput!="") {
    $na = $_SESSION["user"];
    $res = $pdo->query("select id from users where name = \"$na\"");
    $row = $res->fetch(PDO::FETCH_ASSOC);
    $userId = $row["id"];

    $userIdToInsert = (int)$userId;
    $timeToInsert = "now()";
    $stmt = $pdo->prepare("insert into messageM (id,content,time) values (:name,:msgTo,$timeToInsert) ");
    $stmt->bindParam(':name',$userIdToInsert);
    $stmt->bindParam(':msgTo',$msgToInput);
    if (!$stmt) {
        echo "\nPDO::errorInfo():\n";
    }
    $stmt->execute();
}
header("Location:index.php");