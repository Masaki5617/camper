<?php

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:../../campsites/login/login.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/campsite_list.css">
  <title>お気に入り</title>
</head>
<body>
  <div class ="camp_site_head"> 
       <a class ="back" href="mypage.php"><</a>
       <h2>お気に入り</h2>
  </div>
  <div class ="campsite_info">
    <div class ="image">
      <img src="../img/logo_icon.png" alt="キャンプサイトイメージ">
    </div>
    <div class ="info">
      <div class ="institution">
        <p>施設名</p>
      </div>
      <div class ="category">
        <ul>
          <li>カテゴリー/</li>
          <li>カテゴリー</li>
          <li>カテゴリー/</li>
          <li>カテゴリー</li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>