<?php
 
/**
 * このクラスはキャンプサイト一覧表示の為にキャンプサイト情報取得を行います。
 * 
 * get_unique_facilities($facilities) 同じキャンプサイトIDの設備を一つにまとめる。
 * get_unique_structures($structures) 同じキャンプサイトIDの構成を一つにまとめる。
 */



 
require_once(ROOT_PATH."Models/campsites.php");

class campsite_list{

  private $campsites;
  public function __construct(){
    
    $this->campsites = new Campsite();
  }

  public function campsite_controll() 
  {
    $facilities = $this->campsites->get_facilities();
    $structures = $this->campsites->get_structures();
    $campsite = $this->campsites->get_campsite();


    return ["campsite"=>$campsite,"campsite_facilities" => $this->get_unique_facilities($facilities),"campsite_structures"=>$this->get_unique_structures($structures)];

  }

  public static function get_unique_facilities($facilities)
  {
    $campsite_facilities = [];
    $campsite_idsInFacilities = array_unique(array_column($facilities, "campsite_id"));
    foreach ($campsite_idsInFacilities as $campsite_id) {
      $campsite_facilities[$campsite_id] = [];
      foreach ($facilities as $facility) {
        if ($campsite_id == $facility['campsite_id']) array_push($campsite_facilities[$campsite_id], $facility['name']);
      }
    }
    return $campsite_facilities;
  }

  public static function get_unique_structures($structures)
  {
    $campsite_structures = [];
    $campsite_idsInStructures = array_unique(array_column($structures, "campsite_id"));
    foreach ($campsite_idsInStructures as $campsite_id) {
      $campsite_structures[$campsite_id] = [];
      foreach ($structures as $structure) {
        if ($campsite_id == $structure['campsite_id']) array_push($campsite_structures[$campsite_id], $structure['name']);
      }
    }
    return $campsite_structures;
  }
}


?>