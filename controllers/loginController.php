<?php


/**
 * このクラスは一般ユーザーのログインを行います。
 * 
 * バリデーションでエラーがなければhome.phpへ遷移。
 */



 
require_once(ROOT_PATH.'/Models/Login.php');

class loginController {
  private $login;

  public function __construct() {
    $this->request["post"] = $_POST;
    $this->login = new Login();
  }
 
  public function login_controll() {
    if(!empty($this->request["post"])) {
      return $this->login_validate();
    }else if(isset($_SESSION["form"])) {
      $_SESSION = array();
      header("location:login.php");
    }
  }

  public function users_get($email) {
    return $this->login->get_user($email);
  }

  public function get_image() {
    return $images = glob('../public/img/*');
  }

  public function login_validate() {
    $error = [];

    $login = $this->login->get_user($_POST["user_id"]);
    
    if($_POST["user_id"] == "") {
      $error["user_id"] = "no_id";
    }
    if(false===$login) {
      $error["email"] = "no_id";
    } 
    if($_POST["password"] == "") {
      $error["password"] = "no_password";
    }
    if(!password_verify($_POST["password"],$login["password"] ?? "")) {
      $error["password"] = "no_password";
    }
    if(count($error) == 0) {
      $_SESSION["form"] = $this->users_get($_POST["user_id"]);
      header("location:../home.php");
      exit();
    }else{
      $_SESSION["form"] = $_POST;
      return ["error"=>$error];
    }

  }
}
?>
