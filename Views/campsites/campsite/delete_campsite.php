<?php

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

session_start();

require_once(ROOT_PATH."controllers/deleteController.php");

$delete = new deleteController();
$delete->campsite_delete_controll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/delete.css">
  <title>キャンプサイト情報削除</title>
</head>
<body>
  <div class ="delete">
    <h1>キャンプサイト情報を削除しました。</h1>
    <a href="campsite_list.php">キャンプサイト一覧へ戻る</a>
  </div>
</body>
</html>