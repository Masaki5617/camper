<?php

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

session_start();
require_once(ROOT_PATH."controllers/pass_reset_formController.php");



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/reset_complete.css">
  <title>パスワードリセット完了画面</title>
</head>
<body>
  <div class ="reset">
    <h1>リセットが完了いたしました。</h1>
    <a href="../../campsites/login/login.php">ログイン画面へ戻る</a>
  </div>
</body>
</html>