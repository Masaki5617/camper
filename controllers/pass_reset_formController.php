<?php

require_once(ROOT_PATH."Models/pass_reset_form.php");
require_once(ROOT_PATH."Models/register.php");

class reset_form_controll{

  private $reset;
  private $register;
  
  public function __construct()
  {
    $this->request["post"] = $_POST;
    $this->request["get"] = $_GET;
    $this->reset = new Reset();
    $this->register = new Register();
  }

  public function update() {
    if(!empty($this->request["post"])) {
      return $this->validate();
    }
  }

  public function token_controll()
  {
    if(!empty($this->request["get"])) {
      return $this->register->get_token($this->request["get"]["token"]);
      if($this->token === false) {
        header("location:login.php");
      }
    }

  }

  public function validate() {
    $error = [];

    if(isset($_POST["password"]) == "") {
      $error["password"] = "no_password";
    }
    if(isset($_POST["password_conf"]) == "") {
      $error["password"] = "no_password";
    }
    if($_POST["password"] !== $_POST["password_conf"]) {
      $error["password"] = "no_password";
    }
    if(count($error) == 0 ) {
      $this->reset->update($_POST);
      header("location:../../campsites/complete/reset_complete.php");
    }else{
      return ["error"=>$error];
    }
    
  }

}
?>