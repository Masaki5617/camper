<?php

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:../../campsites/login/login.php");
}

session_start();

require_once(ROOT_PATH."controllers/detailController.php");
require_once(ROOT_PATH."controllers/postController.php");
require_once(ROOT_PATH."controllers/favoriteController.php");

$post = new postController();
$post->get_id_controll();
$detail = new detailController();
$params = $detail->detail_controll();
$favorite = new favoriteController();
$isfavorite = $favorite->get_favorite_data([
  "user_id"=>$_SESSION["form"]["id"] ?? 0,
  "campsite_id"=>$params["detail"]["id"] 
]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/detail.css">
  <title>キャンプ場一覧</title>
</head>
<body>
  <div class ="detail_head"> 
    <a class ="back" href="<?=(isset($_SESSION["admin"])) ? "../../campsites/list/campsite_list.php" : "../../campsites/home/home.php"?>"><</a>
    <h2><?=htmlspecialchars($params["detail"]["name"],ENT_QUOTES,"UTF-8");?></h2>
    <?php if(isset($_SESSION["form"])):?>
    <p class="<?php if($isfavorite !== false)
      echo 'on '?>btn_vote" id="vote_01" data-user_id = "<?=htmlspecialchars($_SESSION["form"]["id"] ?? 0,ENT_QUOTES,"UTF-8");?>"></p>
      <?php endif?>
  </div>
  <div class ="detail">
    <div class ="detail_img">
      <div class ="review">
        <a href="../../campsites/post/customer_review.php?id=<?=htmlspecialchars($_SESSION["id"]["id"],ENT_QUOTES,"UTF-8");?>">レビューを見る</a>
      </div>
      <img src="../../img/<?=htmlspecialchars($params["detail"]["image"],ENT_QUOTES,"UTF-8");?>" alt="キャンプ場の写真" class ="campsite_image" >
    </div>
    <div class ="explanation">
      <p>住所：<?=htmlspecialchars($params["detail"]["address"],ENT_QUOTES,"UTF-8");?></p>
      <p>電話番号：<?=htmlspecialchars($params["detail"]["tel"],ENT_QUOTES,"UTF-8");?></p>
      <p>営業時間：<?=htmlspecialchars($params["detail"]["buisiness_hours"],ENT_QUOTES,"UTF-8");?></p>
    </div>
    <div class ="website">
      <p>公式サイト</p>
      <a href=""><?=htmlspecialchars($params["detail"]["url"],ENT_QUOTES,"UTF-8");?></a>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="/js/jquery.raty.js"></script>
  <script src ="/js/detail.js"></script>
</body>
</html>