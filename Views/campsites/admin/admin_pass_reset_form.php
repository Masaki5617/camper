<?php


session_start();

require_once(ROOT_PATH."controllers/admin_pass_reset_formController.php");

$reset = new reset_form_controll();
$token = $reset->token_controll();
$params = $reset->update();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/pass_reset_form.css">
  <title>パスワードリセットフォーム</title>
</head>
<body>
  <div class ="reset_head">
       <a class ="back" href="admin_pass_reset.php"><</a>
       <h2>パスワードリセット</h2>
  </div>
  <div class ="reset">
    <form action="admin_pass_reset_form.php" method = "post">
      <input type="hidden" name ="id" value ="">
      <input type="hidden" name ="token" value ="<?=htmlspecialchars($token,ENT_QUOTES,"UTF-8");?>">
      <div class ="password">
        <?php if(isset($params["error"]["password"]) && $params["error"]["password"] == "no_password" ):?>
          <p class ="error">パスワードは正しく入力してください</p>
        <?php endif?>
        <input type="password" class ="txt" name = "password" placeholder="新規パスワード" value = "">
      </div>
    
      <div class ="password_conf">
        <?php if(isset($params["error"]["password"]) && $params["error"]["password"] == "no_password" ):?>
          <p class ="error">パスワードは正しく入力してください</p>
        <?php endif?>
        <input type="password" class ="txt" name = "password_conf" placeholder="確認パスワード" value = "">
      </div>
      <div class ="submit">
        <input type="submit" value ="登録">
      </div>
    </div>
    </form>
</body>
</html>