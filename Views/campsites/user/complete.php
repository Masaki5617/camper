<?php

session_start();

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}


require_once(ROOT_PATH."controllers/registerController.php");
$register = new registerController();
$params = $register->register_controll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/complete.css">
  <title>登録完了</title>
</head>
<body>
  <div class ="complete">
    <h1>登録が完了いたしました。</h1>
    <a href="login.php">ログインページへ戻る</a>
  </div>
</body>
</html>

