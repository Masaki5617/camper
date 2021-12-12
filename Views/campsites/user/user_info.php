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
  <link rel="stylesheet" href="../../css/user_info.css">
  <title>ユーザー情報</title>
</head>
<body>
  <div class ="mypage_head">
       <a class ="back" href="mypage.php"><</a>
       <h2>ユーザー情報</h2>
    </div>
  </div>
  <div class ="user">
    <div class ="user_info">
      <div class ="name">&nbsp&nbsp&nbsp&nbsp<?=htmlspecialchars($_SESSION["form"]["name"],ENT_QUOTES,"UTF-8");?>さん</div>
      <a href="">編集する</a>
    </div>
  </div>
  <div class ="user_id">
    <p>ユーザーID</p>
    <p>xxxxxxxxx</p>
  </div>
  <div class ="password">
    <p>パスワード</p>
    <p>xxxxxxxxx</p>
  </div>
  <div class ="quit">
    <a href="">退会する</a>
  </div>
</body>
</html>