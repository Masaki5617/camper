<?php

  if(!isset($_SERVER["HTTP_REFERER"])) {
    header("location:../login/login.php");
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/admin_top.css">
  <title>管理者マイページ</title>
</head>
<body>
  <div class ="text">
    <h1>管理者マイページ</h1>
    <a class ="logout" href="../../campsites/login/login.php">ログアウト</a>
  </div>
  <div class ="admin">
    <div class ="campsite_list">
      <a href="../../campsites/list/campsite_list.php">キャンプ場一覧</a>
    </div>
    <div class ="user_list">
      <a href="../../campsites/list/user_list.php">ユーザー情報</a>
    </div>
    <div class ="admin_list">
      <a href="../../campsites/list/admin_list.php">管理ユーザー情報</a>
    </div>
  </div>
</body>
</html>