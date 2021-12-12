<?php

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

session_start();

require_once(ROOT_PATH."controllers/reviewController.php");
require_once(ROOT_PATH."controllers/file_uploadController.php");
require_once(ROOT_PATH."controllers/searchController.php");

$campsite = new campsite_list();
$params = $campsite->campsite_controll();

$file = new file_up();
$file_up = $file->campsite_register();

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $search = new search();
  $params = $search->search_controll();
}
$search = $_SESSION["search"] ?? "";
unset($_SESSION["search"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/home.css">
  <title>ホーム</title>
</head>
<body>
  <div class ="head">
      <h1>ホーム</h1>
      <a class ="mypage" href="user/mypage.php">マイページ</a>
  </div>
  <div class ="err_message">
    <?php if(empty($params["campsite"]) && empty($params["campsite_facilities"]) && empty($params["campsite_structures"])):?>
          <p class ="err">検索結果が見つかりません</p>
          <?php endif?>
  </div>
  
   <article>
     <div class ="search">
         <form action="home.php" method = "post">
         <div class ="prefecture">
           <select class ="option" name="prefecture" id="prefecture">
             <option value="">立地</option>
             <?php foreach($file_up["prefecture"] as $prefecture=>$value1):?>
                <option value="<?=htmlspecialchars($value1["id"],ENT_QUOTES,"UTF-8");?>" <?php if(isset($search["prefecture"]) && $value1["id"] == $search["prefecture"])echo 'selected'?>><?=htmlspecialchars($value1["name"],ENT_QUOTES,"UTF-8");?></option>
                <?php endforeach?>
           </select>
         </div>
         <div class ="check_button">
            <p class ="check_button">
              <?php foreach($file_up["facilities"] as $facilities=>$value1):?>
              <label></label><input type="checkbox" name = "facilities[]" value = "<?=htmlspecialchars($value1["id"],ENT_QUOTES,"UTF-8");?>"><?=htmlspecialchars($value1["name"],ENT_QUOTES,"UTF-8");?></label><br>
              <?php endforeach?>
            </p>
         </div>
            <p class ="check_button1">
              <?php foreach($file_up["structures"] as $structures=>$value1):?>
                <input type="checkbox" name = "structures[]" value = "<?=htmlspecialchars($value1["id"],ENT_QUOTES,"UTF-8");?>"><?=htmlspecialchars($value1["name"],ENT_QUOTES,"UTF-8");?>
                <?php endforeach?>
            </p>
          <div class ="search_button">
           <input type="submit" value = "検索する">
          </div>
        </form>
      </div>
    <div class ="main">
      <?php foreach($params["campsite"] ?? [] as $campsite):?>
        <a class ="detail" href = "campsite/detail_campsite.php?id=<?php echo htmlspecialchars($campsite["id"],ENT_QUOTES,"UTF-8");?>">
         <div class ="campsite_info" id = "campsite_info">
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
                <li><?="/".htmlspecialchars($name,ENT_QUOTES,"UTF-8");?></li>
                <?php endforeach?>
                <?php foreach($params["campsite_structures"][$campsite["id"]] ?? [] as $name):?>
                <li><?="/".htmlspecialchars($name,ENT_QUOTES,"UTF-8");?></li>
                <?php endforeach?>
              </ul>
              </div>
          </div>
         </div>
                </a>
         <?php endforeach?>
    </div>
   </article>
 
</body>
</html>