<?php
    error_reporting(E_ALL);ini_set('display_errors', 1);
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>WTF website</title>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <form method="post" action="msg.php" class="form-inline">
                    <input  name="msgA" class="form-control col-md-8" type="text" id="inputText">
                    <button type="submit" class="btn btn-info col-md-3 col-md-offset-1">提交</button>
                </form>
            </div>
            <div class="row">
                <table class="table">
                    <?php
                    $tdColor = Array("info","danger","success","warning","active");
                    $pdo = new PDO('mysql:host=127.0.0.1;dbname=phpMessage', 'root', 'root');
                    $queryStatement = $pdo->query("select * from users natural join messageM order by time desc");
                    $cnt = 0;
                    while($row = $queryStatement->fetch(PDO::FETCH_ASSOC)) {
                        $colorNum = rand()%5;
                        if($cnt++ % 2 == 0) {
                            echo "<tr class=\"$tdColor[$colorNum]\"><td class=\"col-md-2\">" . htmlentities($row['name']) . "</td><td  class=\"col-md-6\">" . htmlentities($row['content']) . "</td><td  class=\"col-md-4\">" . htmlentities($row['time']) . "</td></tr>";
                        }else{
                            echo "<tr><td class=\"col-md-2\">".htmlentities($row['name'])."</td><td  class=\"col-md-6\">".htmlentities($row['content'])."</td><td  class=\"col-md-4\">".htmlentities($row['time'])."</td></tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <?php
                if(!isset($_SESSION["user"])){
                    echo "<form method=\"post\" action=\"login.php\" class=\"form\"> ";
                    echo "<label>用户名</label>";
                    echo    "<input name=\"user\" class=\"form-control\" type=\"text\">";

                    echo    "<label>密码</label>";
                    echo    "<input name=\"pswd\" class=\"form-control\" type=\"password\">";

                    echo    "<button type=\"submit\" class=\"btn btn-default\">登陆</button>";
                    echo "<a class='btn btn-primary' href='regist.php'>注册</a>";
                    echo "</form>";
                }
                else if($_SESSION["user"]==2) {
                    echo "<span>用户名或密码错误</span>";
                    echo "<p><a class='btn btn-primary' href='logout.php'>返回</a></p>";
                }
                else {
                    echo "<p>登陆成功!</p>";
                    echo "<label>欢迎回来:</label><b>".$_SESSION["user"]."</b>";
                    echo "<p><a class='btn btn-primary' href='logout.php'>注销</a></p>";
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>
