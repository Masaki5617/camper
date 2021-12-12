<?php


/**
 * このクラスはユーザーの口コミ内容の投稿、取得を行います。
 * 
 */


 
require_once(ROOT_PATH.'/Models/post.php');

class postController {
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

  public function post_insert() {
    $this->post->insert_post($_SESSION["id"],$_SESSION["post"],$_SESSION["form"]);
  }

  public function get_post_controll() {
    $post = $this->post->get_post( $this->request["get"]["id"] );
    return ["post"=>$post];
  }

  public function get_id_controll() {
    $_SESSION["id"] = $this->post->get_campsite_id($this->request["get"]["id"]);
  }

  public function validate() {

    $check_post = $this->post->getAll_post($_SESSION["id"],$_SESSION["form"]
    ["id"]);
    $err = [];

    if($_POST["title"] == "") {
      $err["title"] = "no_title";
    }
    if($_POST["review"] == "") {
      $err["review"] = "no_review";
    }
    if(in_array(1,$check_post) == true) {
      $err["get_post"] = "duplicate";
    }
    if(count($err) == 0 ) {
      $_SESSION["post"] = $_POST;
      $this->post_insert();
      header("location:../post/post_complete.php");
    }else{
      $_SESSION["post"] = $_POST;
      return ["err"=>$err];
    }
  }

  
}

?>