<?php


/**
 * このクラスは管理者によるキャンプサイトの登録と編集を行います。
 * 
 * file_up_controll() ポスト送信でバリデーションの実行
 * campsite_register() キャンプサイトのカテゴリーの取得（都道府県・設備・構成）
 * edit_campsite_controll() 現在の登録内容を取得
 * upload() キャンプサイトの登録
 *  edit() キャンプサイトの編集
 */


 
require_once(ROOT_PATH."Models/register.php");
require_once(ROOT_PATH."Models/campsites.php");
require_once(ROOT_PATH."controllers/reviewController.php");

class file_up{

  private $upload;
  private $campsite;

  public function __construct() 
  {
    $this->upload = new Register();
    $this->campsite = new Campsite();
    $this->request["post"] = $_POST;
    $this->request["get"] = $_GET;
  }

  public function file_up_controll() 
  {
    if(!empty($this->request["post"])) {
      return $this->validate();
    }
  }

  public function campsite_register() 
  {
    $facilities = $this->upload->facilities();
    $prefecture = $this->upload->prefectures();
    $structures = $this->upload->structures();

    return ["facilities"=>$facilities,"prefecture"=>$prefecture,"structures"=>$structures];
  }

  public function edit_campsite_controll()
  {
    if(!empty($this->request["get"])) {
      $campsite = $this->campsite->edit_get_campsite($this->request["get"]["id"]);

      $facilities = $this->campsite->edit_get_facilities($this->request["get"]["id"]);

      $structures = $this->campsite->edit_get_structures($this->request["get"]["id"]);

      return ["campsite"=>$campsite,
      "campsite_facilities" => campsite_list:: get_unique_facilities($facilities),"campsite_structures"=>campsite_list:: get_unique_structures($structures)
    ];
    }
  }

  public function validate() 
  {

    $file = $_FILES["img"];
    $filename = basename($file["name"]);
    $tmp_path = $file["tmp_name"];
    $file_err = $file["error"];
    $file_size = $file["size"];
    $upload_dir = "../public/img/";
    $save_filename = date("YmdHis") . $filename;
    $save_path = $upload_dir.$save_filename;

    $err = [];
    $arrow_ext = array("jpg","jpeg","png");
    $file_ext = pathinfo($filename,PATHINFO_EXTENSION);

    if($file_size > 1048576 || $file_err == 2 ) {
      $err["file_size"] = "over_size";
    }
    if(!in_array(strtolower($file_ext),$arrow_ext)) {
      $err["ext"] = "no_file";
    }
    if($_POST["name"] == "") {
      $err["name"] = "no_name";
    }
    if(!isset($_POST["prefecture"])) {
      $err["prefecture"] = "no_prefecture";
    }
    if(!isset($_POST["facilities"])) {
      $err["facilities"] = "no_facilities";
    }
    if(!isset($_POST["structures"])) {
      $err["structures"] = "no_structures";
    }
    if($_POST["address"] == "") {
      $err["address"] = "no_address";
    }
    if($_POST["tel"] == "") {
      $err["tel"] = "no_tel";
    }
    if($_POST["buisiness_hours"] == "") {
      $err["buisiness_hours"] = "no_buisiness_hours";
    }
    if(count($err) == 0 && move_uploaded_file($tmp_path, $save_path)) {
       !isset($this->request["post"]["id"]) ? $this->upload($save_filename) :
      $this->edit($save_filename);
        header("location:../campsite/campsite_list.php");
      }else{
      $_SESSION["form"] = $_POST;
      return ["err"=>$err];
    }
   
  }

  private function upload($save_filename) 
  {
    $this->upload->get_dbh()->beginTransaction();
    try{
      $result_id = $this->upload->campsite_upload($save_filename, $this->request["post"]) ;

      foreach ($this->request["post"]["facilities"] as $value) {
       $this->upload->camp_faciilities($result_id, $value);
      }
      foreach ($this->request["post"]["structures"] as $value) {
       $this->upload->camp_structures($result_id, $value);
      }
      $this->upload->get_dbh()->commit();
    }catch(PDOException $e) {
      echo "接続エラー".$e->getmessage();
       $this->upload->get_dbh()->rollback();
    }

  }

  private function edit($save_filename) 
  {
    $this->upload->get_dbh()->beginTransaction();
    try{
      $this->upload->edit_campsite($save_filename, $this->request["post"]);
      // キャンプサイトのIDが一致するfacilitiesとstructureは全部消す。
      $this->upload->delete_facilities($this->request["post"]["id"]);
      $this->upload->delete_structures($this->request["post"]["id"]);

      foreach ($this->request["post"]["facilities"] as $value) {
        $this->upload->camp_faciilities( $this->request["post"]["id"], $value);
      }
      foreach ($this->request["post"]["structures"] as $value) {
       $this->upload->camp_structures( $this->request["post"]["id"], $value);
      }
      $this->upload->get_dbh()->commit();
    }catch(PDOException $e) {
      echo "接続エラー".$e->getmessage();
       $this->upload->get_dbh()->rollback();
    }

  }

}
