<?php

session_start();

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}
require_once(ROOT_PATH."controllers/registerController.php");
$register = new registerController();
$params = $register->register_validate_controll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/register.css">
  <title>新規会員登録</title>
</head>
<body>
  <div class ="center_logo">
      <a class ="back" href="../../campsites/login/login.php"><</a>
  </div>
  <div class ="register">
    <div class ="register_text">
      <h1>新規会員登録</h1>
    </div>
    <form action="register.php" method ="post">
      <div class ="nickname">
        <?php if(isset($params["error"]["nickname"]) && $params["error"]["nickname"] == "no_name" ):?>
          <p class ="error">ニックネームは正しく入力してください</p>
        <?php endif?>
        <input type="text" class ="txt" name = "nickname" placeholder="ニックネーム" value = "<?=htmlspecialchars($_SESSION["form"]["nickname"] ?? "",ENT_QUOTES,"UTF-8");?>">
      </div>

      <div class ="user_id">
        <?php if(isset($params["error"]["user_id"]) && $params["error"]["user_id"] == "no_id" ):?>
          <p class ="error">ユーザーIDは正しく入力してください</p>
        <?php endif?>
        <input type="text" class ="txt" name = "user_id" placeholder="ユーザID" value = "<?=htmlspecialchars($_SESSION["form"]["user_id"] ?? "",ENT_QUOTES,"UTF-8");?>">
      </div>

      <div class ="password">
        <?php if(isset($params["error"]["password"]) && $params["error"]["password"] == "no_password" ):?>
          <p class ="error">パスワードは正しく入力してください</p>
        <?php endif?>
        <input type="password" class ="txt" name = "password" placeholder="パスワード" value = "">
      </div>

      <div class ="password_conf">
        <?php if(isset($params["error"]["password"]) && $params["error"]["password"] == "no_password" ):?>
          <p class ="error">パスワードは正しく入力してください</p>
        <?php endif?>
        <input type="password" class ="txt" name = "password_conf" placeholder="確認パスワード" value = "">
      </div>

      <div class ="push_password">
        <input type="submit" class ="submit" value ="登録">
      </div>
    </form>
    </div>
</body>
</html>