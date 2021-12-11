<?php

require_once(ROOT_PATH.'/Models/post.php');

class edit_postController {
  private $post;

  public function __construct() 
  {
    $this->request["get"]["id"] = $_GET;
    $this->request["post"]= $_POST;
    $this->post = new Post();
  }


  public function validateControll() {
    if(!empty($this->request["post"])) {
      return $this->validate();
    }
  }

  public function post_update_controll() {
   $this->post->post_update($_SESSION["post"],$_SESSION["form"]);
  }

  public function validate() {

    $err = [];

    if($_POST["title"] == "") {
      $err["title"] = "no_title";
    }
    if($_POST["review"] == "") {
      $err["review"] = "no_review";
    }
    if(count($err) == 0 ) {
      $_SESSION["post"] = $_POST;
      $this->post_update_controll();
      header("location:../complete/post_update_complete.php");
    }else{
      $_SESSION["post"] = $_POST;
      return ["err"=>$err];
    }
  }

  
}

?>