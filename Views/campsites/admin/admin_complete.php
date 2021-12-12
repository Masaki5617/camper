<?php

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

session_start();


require_once(ROOT_PATH."controllers/admin_controller.php");
$admin = new admin_controll();
$admin->admin_controll();

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
    <a href="admin_login.php">ログインページへ戻る</a>
  </div>
</body>
</html>
