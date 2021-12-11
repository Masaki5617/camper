<?php

require_once(ROOT_PATH."Models/admin.php");
require_once(ROOT_PATH."Models/register.php");

class reset_form_controll{

  private $reset;
  private $admin;

  public function __construct()
  {
    $this->request["post"] = $_POST;
    $this->request["get"] = $_GET;
    $this->admin = new Admin();
    $this->register = new Register();
  }

  
  public function update() {
    if(!empty($this->request["post"])) {
      return $this->validate();
    }
  }

  /**
   * トークンを取得しパスリセ認証
   * DBに登録してあるトークンとgetで取得したトークンを比較し一致していればパスリセ画面へ遷移。不一致でログイン画面へ遷移。
   * @param string $this->request["get"]["token"] 
   * @return 
   */
  public function token_controll()
  {
    if(!empty($this->request["get"])) {
      return $this->admin->get_token($this->request["get"]["token"]);
      if($this->token === false) {
        header("location:login.php");
      }
    }
  }

  public function validate() {
    $error = [];
    if(!isset($_POST["password"]) || !isset($_POST["password_conf"])) $error["password"] = "no_password";
    if($_POST["password"] !== $_POST["password_conf"]) $error["password"] == "no_password";

    if (count($error) > 0) return ["error"=>$error];
    
    $this->admin->admin_update($_POST);
    header("location:admin_login.php");
    
  }

}
?>