<?php


/**
 * このクラスはユーザーの会員登録を行います。
 * 
 */



require_once(ROOT_PATH.'/Models/Login.php');
require_once(ROOT_PATH.'/Models/register.php');

class registerController {
  private $register;

  public function __construct() {
    $this->request["post"] = $_POST;
    $this->register = new Register();
  }

  public function  register_controll() {
    $this->register->UsersData($_SESSION["form"]); 
  } 

  public function register_validate_controll() {
    if(!empty($this->request["post"])) {
      return $this->register_validate();
    }
  }

  public function register_validate() {

    $error= [];
    $password_str = '/\A[a-z\d]{8,100}+\z/i';

    if($_POST["nickname"] == "") {
      $error["nickname"] = "no_name";
    }
    if($_POST["user_id"] == "") {
      $error["user_id"] = "no_id";
    }
    if($_POST["password"] == "") {
      $error["password"] = "no_password";
    }
    if(!preg_match($password_str,$_POST["password"])) {
      $error["password"] = "no_password";
    }
    if($_POST["password_conf"] == "") {
      $error["password"] = "no_password";
    }
    if($_POST["password"] !== $_POST["password_conf"] ) {
      $error["password"] = "no_password";
    }
    if(count($error) == 0) {
      $_SESSION["form"] = $_POST;
      header("location:complete.php");
    }else{
      $_SESSION["form"] = $_POST;
      return ["error"=>$error];
    }
  }

  
}

?>