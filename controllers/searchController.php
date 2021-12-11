<?php

require_once(ROOT_PATH."Models/campsites.php");
require_once(ROOT_PATH."controllers/reviewController.php");

class search{

  private $campsite;

  public function __construct() 
  {
    $this->campsite = new Campsite();
    $this->request["post"] = $_POST;
  }

  public function search_controll() 
  {
    if(!empty($this->request["post"])) {
     return $this->validate();
    }
  }

  public function search()
  {
    $_SESSION["search"] = $_POST;
    $campsites = $this->campsite->search($_POST);
    $facilities = $this->campsite->search_get_facilities($campsites);
    $structures = $this->campsite->search_get_structures($campsites);

    return [
      "campsite"=>$campsites,
      "campsite_facilities" => campsite_list:: get_unique_facilities($facilities),"campsite_structures"=>campsite_list:: get_unique_structures($structures)
    ];
    
  }


  public function validate() 
  {
    $err = [];

      if(empty($_POST["prefecture"])) {
        $err["prefecture"] = "no_prefecture";
      }
      if(!isset($_POST["facilities"])) {
        $err["facilities"] = "no_facilities";
      }
      if(!isset($_POST["structures"])) {
        $err["structures"] = "no_structures";
      }
      if(count($err) == 0) {
        return $this->search($_POST);
      }else{
        return ["err"=>$err];
      }
  }

}
  