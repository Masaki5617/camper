<?php
if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

session_start();

require_once(ROOT_PATH."controllers/postController.php");

$post = new postController();
$validate = $post->validateControll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/post.css">
  <title>投稿</title>
</head>
<body>
  <div class ="customer_review_head"> 
    <a class ="back" href="customer_review.php?id=<?=htmlspecialchars($_SESSION["id"]["id"],ENT_QUOTES,"UTF-8");?>"><</a>
    <h2>カスタマーレビュー</h2>
  </div>
  <form action="post.php" method = "post">
    <div class ="post">
      <div class ="star">
        <p id="star1"></p>
      </div>
      <div class ="duplicate">
        <?php if(isset($validate["err"]) ?? [] && $validate["err"]["get_post"]  == "duplicate" ?? "" ):?>
          <p class ="err">投稿はお一人様一回のみになります。</p>
      <?php endif?>
      </div>
      <div class ="title">
        <p>タイトルの追加</p>
        <?php if(isset($validate["err"]) ?? [] && $validate["err"]["title"] == "no_title"):?>
          <p class ="err">タイトルを入力してください</p>
        <?php endif?>
        <input type="text" name ="title" vlue ="<?= htmlspecialchars($_SESSION["post"]["title"] ?? "",ENT_QUOTES,"UTF-8")?>">
      </div>
      <div class ="review">
        <p>レビューの追加</p>
        <?php if(isset($validate["err"]) ?? [] && $validate["err"]["review"] == "no_review"):?>
          <p class ="err">レビューを入力してください</p>
        <?php endif?>
        <textarea class ="textarea" name ="review"></textarea>
      </div>
      <div class ="post_button">
        <input type="submit" value ="投稿">
      </div>
    </div>
  </form>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="/js/jquery.raty.js"></script>
  <script src ="/js/post.js"></script>
</body>
</html>