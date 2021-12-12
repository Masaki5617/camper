<?php

session_start();
$_SESSION = array();


require_once(ROOT_PATH."controllers/loginController.php");
$login = new loginController();
$params = $login->login_controll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/login.css">
  <title>ログイン</title>
</head>
<body>
    <div class ="login">
      <h1>ログイン</h1>
    </div>
    <form action="login.php" method = "post">
    <div class ="input_login">
      <div class ="user_id">
        <?php if(isset($params["error"]["user_id"]) && $params["error"]["user_id"] == "no_id"):?>
          <p class ="error">IDを正しく入力してください</p>
        <?php endif?>

        <input type="text" class ="txt" name = "user_id" placeholder="ユーザID" value = "<?= htmlspecialchars($_SESSION["form"]["user_id"] ?? "",ENT_QUOTES,"UTF-8");?>">
      </div>

      <div class ="password">
        <?php if(isset($params["error"]["password"]) && $params["error"]["password"] == "no_password"):?>
          <p class ="error">パスワードを正しく入力してください</p>
        <?php endif?>

        <input type="password" class ="txt" name = "password" placeholder="パスワード" value = "">
      </div>

      <div class ="pass_Reset">
        <a href="pass_Reset.php">パスワードをお忘れですか？</a>
      </div>
        <input type="submit" class ="submit" value ="ログイン">
    </form>
      <div class ="text">
        <h5>もしくは</h5>
      </div>
      <a class ="register" href="">Googleでログインする</a>
      <a class ="register" href="register.php">新規会員登録</a>
      <div class ="admin_login">
        <a href="../admin/admin_login.php">管理者ログイン</a>
      </div>
    </div>
</body>
</html>


