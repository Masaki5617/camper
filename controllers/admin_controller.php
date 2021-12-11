<?php

require_once(ROOT_PATH.'/Models/admin.php');

class admin_controll {
  private $admin;

public function __construct()
{
  $this->request["post"] = $_POST;
  $this->admin = new Admin();
}
/**
 * 管理者の登録を行う
 * @param array $_SESSION["admin"] post送信の値
 * @return void
 */     
public function admin_controll() {
  $this->admin->adminData($_SESSION["admin"]); 
} 

/**
 * バリデーション実行
 * ポスト送信でadmin_validateを実行
 * @return array $this->admin_validate();
 */
public function admin_validate_controll() {
  if(!empty($this->request["post"])) {
    return $this->admin_validate();
  }
}

/**
 * バリデーション
 * 新規管理者登録の際のバリデーションチェック。エラー０でセッションに格納
 * @return array ["error"=>$error]
 */
public function admin_validate() {

  $error= [];
  $password_str = '/\A[a-z\d]{8,100}+\z/i';

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
    $error["password_conf"] = "no_password";
  }
  if(count($error) == 0) {
    $_SESSION["admin"] = $_POST;
    header("location:../complete/admin_complete.php");
  }else{
    $_SESSION[""] = $_POST;
    return ["error"=>$error];
  }
}


}

?>