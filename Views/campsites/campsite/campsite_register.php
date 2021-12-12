<?php

session_start();

if(!isset($_SERVER["HTTP_REFERER"])) {
  header("location:login.php");
}

require_once(ROOT_PATH."controllers/file_uploadController.php");
$upload = new file_up();
$params = $upload->file_up_controll();
$file_up = $upload->campsite_register();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/file_upload.css">
  <title>キャンプサイト登録画面</title>
</head>
<body>
  <div class ="file_up_head"> 
       <a class ="back" href="campsite_list.php"><</a>
       <h2>キャンプサイト登録</h2>
  </div>
  <div class ="main">
    <form enctype="multipart/form-data" action = "campsite_register.php" method = "post">
      <div class ="file_up">
        <p>
          <label for="position">施設名</label>
          <input type="text" class ="txt" name ="name" value ="<?=htmlspecialchars($_SESSION["form"]["name"] ?? "",ENT_QUOTES,"UTF-8");?>" >
          <?php if(isset($params["err"]["name"]) && $params["err"]["name"] == "no_name"):?>
            <p class ="error">施設名を入力してください</p>
          <?php endif?>
        </p>
        <p>
          <label for="prefecture">県名</label>
          <select class ="option" name="prefecture" id="prefecture">
            <option value="">選択してください</option>
            <?php foreach($file_up["prefecture"] as $prefecture=>$value1):?>
              <option value="<?=htmlspecialchars($value1["id"],ENT_QUOTES,"UTF-8");?>"<?php if(isset($_SESSION["form"]["prefecture"]) && $value1["id"] == $_SESSION["form"]["prefecture"])echo "selected"?>><?=htmlspecialchars($value1["name"],ENT_QUOTES,"UTF-8");?></option>
              <?php endforeach?>
            </select>
            <?php if(isset($params["err"]["prefecture"]) && $params["err"]["prefecture"] == "no_prefecture"):?>
              <p class ="error">都道府県を選択してください</p>
            <?php endif?>
        </p>
        <p class ="check_button">
          <label for="facilities">設備</label>
          <?php if(isset($params["err"]["facilities"]) && $params["err"]["facilities"] == "no_facilities"):?>
            <p class ="error">設備を選択してください</p>
            <?php endif?>
            <?php foreach($file_up["facilities"] as $facilities=>$value1):?>
              <input type="checkbox" name = "facilities[]" value = "<?=htmlspecialchars($value1["id"],ENT_QUOTES,"UTF-8");?>"><?=htmlspecialchars($value1["name"],ENT_QUOTES,"UTF-8");?>
              <?php endforeach?>
        </p>

        <p class ="check_button">
          <label for="structures">構成</label>
          <?php foreach($file_up["structures"] as $structures=>$value1):?>
            <input type="checkbox" name = "structures[]" value = "<?=htmlspecialchars($value1["id"],ENT_QUOTES,"UTF-8");?>"><?=htmlspecialchars($value1["name"],ENT_QUOTES,"UTF-8");?>
            <?php endforeach?>
            <?php if(isset($params["err"]["structures"]) && $params["err"]["structures"] == "no_structures"):?>
              <p class ="error">構成を選択してください</p>
              <?php endif?>
        </p>
        <p>
          <label for="position">住所</label>
          <input type="text" class ="txt" name ="address" value ="<?=htmlspecialchars($_SESSION["form"]["address"] ?? "",ENT_QUOTES,"UTF-8");?>" >
          <?php if(isset($params["err"]["address"]) && $params["err"]["address"] == "no_address"):?>
            <p class ="error">住所を入力してください</p>
            <?php endif?>
        </p>

        <p>
          <label for="tel">電話番号</label>
          <input type="tel" class ="txt"  name ="tel" value ="<?=htmlspecialchars($_SESSION["form"]["tel"] ?? "",ENT_QUOTES,"UTF-8");?>" >
          <?php if(isset($params["err"]["tel"]) && $params["err"]["tel"] == "no_tel"):?>
            <p class ="error">電話番号を入力してください</p>
            <?php endif?>
        </p>

        <p>
          <label for="buisiness_hours">営業時間</label>
          <input type="text" class ="txt"  name ="buisiness_hours" value ="<?=htmlspecialchars($_SESSION["form"]["buisiness_hours"] ?? "",ENT_QUOTES,"UTF-8");?>" >
          <?php if(isset($params["err"]["business_hours"]) && $params["err"]["business_hours"] == "no_business_hours"):?>
            <p class ="error">営業時間を入力してください</p>
            <?php endif?>
        </p>

        <p>
          <label for="url">url</label>
          <input type="text" class ="txt"  name ="url" value ="<?=htmlspecialchars($_SESSION["form"]["url"] ?? "",ENT_QUOTES,"UTF-8");?>" >
        </p>
        
        <input type="hidden" name ="MAX_FILE_SIZE" value = "1048576">
        <input type="hidden" name ="MAX_FILE_SIZE" value = "1048576">
        <div class ="file">
          <label for="image">画像</label>
          <input name="img" type = file accept = "image/*">
        </div>
        <?php if($params["err"]["ext"] ?? "" && $params["err"]["ext"] = "no_file" ?? ""):?>
        <p class ="error">ファイルを選択してください。</p>
        <?php endif?>
        <?php if($params["err"]["file_size"] ?? "" && $params["err"]["file_size"] = "over_size" ):?>
        <p class ="error">ファイルサイズは1MB未満にしてください。</p>
        <?php endif?>
      </div>
      <div class ="submit">
        <input type="submit" value ="登録" class ="button">
      </div>
    </form>
  </div>
</body>
</html>