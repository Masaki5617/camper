<?php


/**
 * このクラスはキャンプサイトの詳細情報を取得します。
 * 
 * キャンプサイトのIDをGETで送信し、該当のキャンプサイトの詳細を取得。
 */


 
require_once(ROOT_PATH.'/Models/campsites.php');

class detailController {
  private $campsite;

  public function __construct() 
  {
    $this->request["get"]["id"] = $_GET;
    $this->campsite = new Campsite();
  }

  public function detail_controll()
  {
    $detail = $this->campsite->get_detail($this->request["get"]["id"]);
    return ["detail"=>$detail];
  }

  

  
}

?>