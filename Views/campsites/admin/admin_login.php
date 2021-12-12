<?php

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

session_start();

  require_once(ROOT_PATH."controllers/admin_loginController.php");

  $login = new admin_loginControll();
  $params = $login->login_controll(); 

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/admin_login.css">
  <title>管理者ログイン</title>
</head>
<body>
  <div class ="center_logo">
      <a class ="back" href="../user/login.php"><</a>
  </div>
  <div class ="input_login">
    <div class ="register_text">
      <h1>管理者ログイン</h1>
    </div>
    <form action="admin_login.php" method = "post">
      <div class ="user_id">
        <?php if(isset($params["error"]["user_id"]) && $params["error"]["user_id"] == "no_id"):?>
          <p class ="error">IDを正しく入力してください</p>
        <?php endif?>
        <input type="text" class ="txt" name = "user_id" placeholder="ユーザID" value = "">
      </div>

      <div class ="password">
      <?php if(isset($params["error"]["password"]) && $params["error"]["password"] == "no_password"):?>
          <p class ="error">パスワードを正しく入力してください</p>
        <?php endif?>
        <input type="password" class ="txt" name = "password" placeholder="パスワード" value = "">
      </div>

      <div class ="pass_Reset">
        <a href="admin_pass_reset.php">パスワードをお忘れですか？</a>
      </div>
        <input type="submit" class ="submit" value ="ログイン">
      <a class ="register" href="register_admin.php">新規会員登録</a>
    </div>
    </form>
</body>
</html>