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
  <link rel="stylesheet" href="../../css/admin_list.css">
  <title>管理者情報一覧</title>
</head>
<body>
  <div class ="admin_head"> 
       <a class ="back" href="../../campsites/mypage/admin_top.php"><</a>
       <h2>管理者情報一覧</h2>
  </div>

  <table>
    <tr>
      <th>ユーザーID</th>
      <th>会員状況</th>
    </tr>
    <tr>
      <td>xxxxxx</td>
      <td>xxxxxx</td>
      <td></td>
      <td><a herf ="delete.php">削除</td></a>
    </tr>
  </table>
</body>
</html>