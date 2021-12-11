<?php


session_start();

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/mypage.css">
  <title>マイページ</title>
</head>
<body>
  <div class ="mypage_head">
       <a class ="back" href="../../campsites/home/home.php"><</a>
       <h2>マイページ</h2>
       <a class ="logout" href="../../campsites/login/login.php">ログアウト</a>
    </div>
  </div>
  <div class ="admin">
    <div class ="user_info">
      <div class ="name">&nbsp&nbsp&nbsp&nbsp<?=htmlspecialchars($_SESSION["form"]["name"],ENT_QUOTES,"UTF-8");?>さん</div>
    </div>
    <div class ="campsite_list">
      <a href="../../campsites/info/user_info.php">ユーザー情報</a>
    </div>
    <div class ="user_list">
      <a href="">お気に入り</a>
    </div>
    <div class ="admin_list">
      <a href="">閲覧履歴</a>
    </div>
  </div>
</body>
</html>