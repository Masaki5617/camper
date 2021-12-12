<?php

require_once(ROOT_PATH."controllers/reviewController.php");
require_once(ROOT_PATH."controllers/file_uploadController.php");

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

$campsite = new campsite_list();
$file = new file_up();
$params = $campsite->campsite_controll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/campsite_list.css">
  <title>キャンプ場一覧</title>
</head>
<body>
  <div class ="camp_site_head"> 
       <a class ="back" href="../admin/admin_top.php"><</a>
       <h2>キャンプサイト一覧</h2>
       <a class ="register" href="campsite_register.php">新規登録</a>
  </div>
  <?php foreach($params["campsite"] as $campsite):?>
    <a class ="detail" href = "detail_campsite.php?id=<?php echo htmlspecialchars($campsite["id"],ENT_QUOTES,"UTF-8");?>">
    <div class ="campsite_info" >
      <div class ="image">
        <img src="../../img/<?=htmlspecialchars($campsite["image"],ENT_QUOTES,"UTF-8");?>" alt="キャンプサイトイメージ">
      </div>
      <div class ="info">
        <div class ="institution">
          <p><?= htmlspecialchars($campsite["name"],ENT_QUOTES,"UTF-8");?></p>
        </div>
        <div class ="prefecture">
        <p><?= htmlspecialchars($campsite["prefecture"],ENT_QUOTES,"UTF-8");?></p>
        </div>
        <div class ="category">
          <ul>
            <?php foreach($params["campsite_facilities"][$campsite["id"]] ?? [] as $name):?>
            <li><?="/".$name?></li>
            <?php endforeach?>
            <?php foreach($params["campsite_structures"][$campsite["id"]] ?? [] as $name):?>
            <li><?="/".htmlspecialchars($name,ENT_QUOTES,"UTF-8");?></li>
            <?php endforeach?>
          </ul>
        </div>
      </div>
    </div>
  </a>
  <div class ="edit_delete">
    <td><a href="edit_campsite.php?id=<?=$campsite["id"];?>">編集</a></td>
    <td><a class = "delete" href= "delete_campsite.php?id=<?=$campsite["id"];?>">削除</a></td>
  </div>
  <?php endforeach?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src ="/js/campsite_list.js"></script>
</body>
</html>