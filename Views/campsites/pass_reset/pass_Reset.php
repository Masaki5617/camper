<?php

session_start();

require_once(ROOT_PATH."controllers/pass_ResetController.php");

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

$pass_Reset = new pass_ResetController();
$params = $pass_Reset->validate_controll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/pass_Reset.css">
  <title>パスワードリセット</title>
</head>
<body>
  <div class ="passReset_head"> 
       <a class ="back" href="../../campsites/login/login.php"><</a>
       <h2>パスワードリセット</h2>
  </div>
  <form action="pass_Reset.php" method = "post">
    <div class ="password_Reset">
      <div class ="text">
        <p>ご登録しているメールアドレスを入力してください</p>
      </div>
      <div class ="user_id">
        <?php if(isset($params["error"]["address"]) && $params["error"]["address"] == "no_address"):?>
          <p class ="error">メールアドレスを入力してください</p>
        <?php endif?>
        <input type="text" class ="txt" name = "address" placeholder="メールアドレス" value = "<?= htmlspecialchars($_SESSION["form"]["address"] ?? "",ENT_QUOTES,"UTF-8")?>">
      </div>
      <?php if(isset($_SESSION["user"])):?>
      <div class ="message">
        <p>ご登録しているアドレスへメールを送信いたしました。</p>
        <p>本文に記載しているURLからパスワードをリセットしてください</p>
      </div>
      <?php endif?>
      <div class ="push_password">
        <input type="submit" class ="submit" value ="送信する">
      </div>
    </div>
  </form>
</body>
</html>