<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 15/7/10
 * Time: 下午4:15
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
$userName = $_POST["user"];
$pswd = $_POST["pwd"];
$pswd2 = $_POST["pwd2"];
$code = trim($_POST["code_num"]);
session_start();
if($userName=="" || $pswd=="" || $pswd2=="" || $code=="") {
    $_SESSION["re"] = 1;
    header("Location:regist.php");
}
elseif ($pswd!=$pswd2) {
    $_SESSION["re"] = 2;
    header("Location:regist.php");
}
elseif ($code != $_SESSION["code_num"]) {
    $_SESSION["re"] = 3;
    header("Location:regist.php");
}
else {
    $pwdhashed = password_hash($pswd, PASSWORD_DEFAULT);
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=phpMessage', 'root', '123456');
    $res = $pdo->query("select max(id) from users");
    $row = $res->fetch(PDO::FETCH_ASSOC);
    $cnt = (int)($row["max(id)"]);
    $cnt++;
    $stmt = $pdo->prepare("insert into users(id,name,pwd) values(:id,:name,:pwd)");
    $stmt->bindParam(':id',$cnt);
    $stmt->bindParam(':name',$userName);
    $stmt->bindParam('pwd',$pwdhashed);
    $stmt->execute();
    header("Location:index.php");
}
