<?php

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
  <link rel="stylesheet" href="../../css/edit_user.css">
  <title>ユーザー情報の編集</title>
</head>
<body>
  <div class ="edit_head">
       <a class ="back" href="mypage.php"><</a>
       <h2>ユーザー情報の編集</h2>
    </div>
  </div>
  <div class ="user">
    <div class ="user_info">
      <img src="../img/logo_icon.png" alt="ユーザーのアイコン">
      <div class ="name">&nbsp&nbsp&nbsp&nbsp◯◯さん</div>
    </div>
  </div>
  <div class ="edit">
    <div class ="user_id">
      <label for="id">ユーザーID</label>
      <input type="text" class ="txt" name ="ID" value ="">
    </div>
    <div class ="password">
      <label for="password">パスワード</label>
      <input type="password" class ="txt" name ="password" value ="">
    </div>
    <div class ="password_conf">
      <label for="password_conf">確認パスワード</label>
      <input type="password" class ="txt" name ="password_conf" value ="">
    </div>
    <div class ="edit_button">
      <input type="submit" class ="submit" value ="編集する">
    </div>
  </div>
</body>
</html>