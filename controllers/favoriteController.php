<?php


/**
 * このクラスはユーザーのお気に入り登録を行います。
 * 
 * ハートボタンクリックでモデルのfavoriteテーブルへユーザーIDとキャンプサイトIDを登録。
 */



 
require_once(ROOT_PATH."Models/favorite.php");

class favoriteController {

  private $favorite;
  // const REGISTERD = true;
  // const DEREGISTERD = false;

  public function __construct() {
    $this->request["post"] = $_POST;
    $this->favorite = new favorite();
  }

  
  public function get_favorite_data($data) {
    return $this->favorite->get_favorite($data);
  }
  
  public function favorite_controll() {
    $data = $this->get_favorite_data($this->request["post"]);
    if($data === false) {
      $this->favorite->insert_favorite($this->request["post"]);
      return "登録";
    }
    $this->favorite->delete_favorite($this->request["post"]);
    return "解除";
  }
  

}

