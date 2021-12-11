<?php

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

session_start();

require_once(ROOT_PATH."controllers/postController.php");

$post = new postController();
$params = $post->get_post_controll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/customer_review.css">
  <title>カスタマーレビュー</title>
</head>
<body>
  <div class ="customer_review_head"> 
    <a class ="back" href="../../campsites/detail/detail_campsite.php?id=<?=htmlspecialchars($_SESSION["id"]["id"] ?? "",ENT_QUOTES,"UTF-8");?>"><</a>
    <h2>カスタマーレビュー</h2>
  </div>

  <div class ="customer">
    <div class ="evaluation">
      <?php if(empty($params["post"])):?>
      <p>このキャンプ場のレビューはございません</p>
      <?php endif?>
      <?php if(isset($_SESSION["form"])):?>
      <a href="../../campsites/post/post.php?id=<?=htmlspecialchars($_SESSION["id"]["id"],ENT_QUOTES,"UTF-8");?>">&nbsp&nbsp&nbspレビューを書く</a>
      <?php endif?>
    </div>
    <?php foreach($params["post"] as $post):?>
    <div class ="user">
      <div class ="star" id="star" data-score="<?=htmlspecialchars($post['score'],ENT_QUOTES,"UTF-8");?>"></div>
      <div class ="name">&nbsp&nbsp&nbsp&nbsp<?=htmlspecialchars($post["name"],ENT_QUOTES,"UTF-8");?>さん</div>
    </div>
    <div class ="user_title">
      <p><?=nl2br(htmlspecialchars($post["title"],ENT_QUOTES,"UTF-8"));?></p>
    </div>
    <div class ="user_review">
      <p><?=nl2br(htmlspecialchars($post["review"],ENT_QUOTES,"UTF-8"));?></p>
    </div>
    <div class ="edit">
      <?php if((isset($_SESSION["form"]) && $post["user_id"]  == $_SESSION["form"]["id"]) && !isset($_SESSION["admin"])):?>
      <td><a href="../../campsites/edit/edit_post.php?id=<?=$post["user_id"];?>">編集</a></td>
      <?php endif?>
      <?php if((isset($_SESSION["form"]) && $post["user_id"]  == $_SESSION["form"]["id"]) || isset($_SESSION["admin"])):?>
      <td><a class = "delete" href= "../../campsites/delete/delete_post.php?id=<?=$post["user_id"];?>">削除</a></td>
      <?php endif?>
    </div>
  </div>
  <?php endforeach?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="/js/jquery.raty.js"></script>
  <script src ="/js/customer_review.js"></script>
</body>
</html>