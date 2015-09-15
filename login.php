<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 15/7/10
 * Time: 下午2:37
 */

error_reporting(E_ALL);ini_set('display_errors', 1);

$pdo = new PDO('mysql:host=127.0.0.1;dbname=phpMessage', 'root', 'root');
$userName = $_POST["user"];
$pwd = $_POST["pswd"];

$queryRes = $pdo->query("select pwd from users where name = \"$userName\"");
$row = $queryRes->fetch(PDO::FETCH_ASSOC);

session_start();
if(password_verify($pwd,$row["pwd"])) {
    $_SESSION["user"] = $_POST["user"];
}
else {
    $_SESSION["user"] = 2;
}

function password_verify($p1, $p2)
{
	if($p1==$p2)
	{
		return 1;
	}else{
		return 0;
	}
}


header("Location:index.php");
