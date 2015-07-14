<?php
/**
 * Created by PhpStorm.
 * User: cong
 * Date: 15/7/10
 * Time: 下午4:15
 */

session_start();
unset($_SESSION["user"]);
header("Location:index.php");