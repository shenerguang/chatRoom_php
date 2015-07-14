<?php
    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors",1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>
<?php
    if(isset($_SESSION["re"])) {
        echo "<!--";
    }
?>
<div class="panel" style="margin-top: 10%">
    <form method="post" action="register.php" class="form">
        <p>
            <label class="reL">用户名</label>
            <input name="user" type="text" />
        </p>
        <p>
            <label class="reL">密码</label>
            <input name="pwd" type="password" />
        </p>
        <p>
            <label class="reL">确认密码</label>
            <input name="pwd2" type="password" />
        </p>
        <p><label class="reL">验证码</label><input type="text" class="input" id="code_num" name="code_num" maxlength="4" />
            <img src="code.php" id="getcode_num" title="看不清，点击换一张" align="absmiddle"></p>
        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="buttonRegister">确定</button>
    </form>
</div>
<?php
if(isset($_SESSION["re"])) {
    echo "-->";

    if($_SESSION["re"]==1) {
        echo "<p style='text-align: center'><label>信息输入不完全</label></p>";
    }
    elseif($_SESSION["re"]==2) {
        echo "<p style='text-align: center'><label>两次输入密码不一致</label></p>";
    }
    elseif($_SESSION["re"]==3) {
        echo "<p style='text-align: center'><label>验证码错误</label></p>";
    }
    unset($_SESSION["re"]);
    echo "<p style='text-align: center'><a type='button' class='mdl-button mdl-js-button mdl-button--raised mdl-button--colored' href='index.php'>返回</a></p>";
}
?>

<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/material.min.js"></script>
<script>
    $(function(){
        //数字验证
        $("#getcode_num").click(function(){
            $(this).attr("src",'code.php?' + Math.random());
        });
    });
</script>
</body>
</html>