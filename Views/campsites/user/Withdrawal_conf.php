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
  <link rel="stylesheet" href="../../css/withdrawal_conf.css">
  <title>退会確認</title>
</head>
<body>
    <div class ="conf_head">
       <a class ="back" href="mypage.php"><</a>
       <h2>退会確認</h2>
    </div>
    <div class ="body">
      <div class ="conf">
        <h2>退会前にご確認ください！</h2>
      </div>
      <div class ="conf_Sentence">
        <p>退会後はお気に入り、閲覧履歴の情報は消えてしまいます。 再度登録した際も履歴は復元できませんのでご了承ください</p>
      </div>
      <div class ="button">
        <div class ="cancel">
          <input type="submit" name ="cancel" value ="キャンセル">
        </div>
        <div class ="withdrawal">
          <input type="submit" name ="withdrawal" value ="退会">
        </div>
      </div>
    </div>
</body>
</html>