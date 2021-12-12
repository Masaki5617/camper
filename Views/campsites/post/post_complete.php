<?php
if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

session_start();

require_once(ROOT_PATH."controllers/postController.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/post_complete.css">
  <title>投稿が完了画面</title>
</head>
<body>
  <div class ="complete"></div>
  <h1>投稿が完了しました。</h1>
  <a href = "../customer_review.php?id=<?=htmlspecialchars($_SESSION["id"]["id"],ENT_QUOTES,"UTF-8");?>">レビュ一覧へ戻る</a>
</body>
</html>