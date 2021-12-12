<?php


/**
 * このクラスはパスワードリセットの際に確認メールを送信します。
 * 
 * バリデーションでエラーがなければトークンを生成しDBへ登録。
 * 登録したトークンをURLへ格納しメール送信。
 */


 
require_once(ROOT_PATH."Models/pass_Reset.php");
require_once(ROOT_PATH."Models/admin.php");
require_once(ROOT_PATH."Models/register.php");

class pass_ResetController {

  protected $passReset;
  protected $request;
  protected $admin;
  private $register;

  public function __construct(){
    $this->request["post"] = $_POST;
    $this->passReset = new pass_Reset();
    $this->admin = new Admin();
    $this->register = new  Register();
  }

  /**
   * @param void
   * @return array|null error
   */
  public function validate_controll() {
    if(!empty($this->request["post"])) {
      return $this->validate();
    }
  }

  public function validate() {

    $email = $_POST['address'];
    $subject = "パスワードをリセットしてください"; // 題名 
    $header = "From: m.sugano.1357@gmail.com";
    $header = "Content-type: text/html; charset=UTF-8";
    
    $error = [];
    $user = !strstr($_SERVER["REQUEST_URI"],"admin") ? $this->passReset->pass_Reset($_POST["address"]) : $this->admin->admin_pass_Reset($_POST["address"]);
 
   
    if(false === $user) {
      $error["address"] = "no_address";
    }
    if(count($error)== 0) {
      $token = md5(uniqid(rand(), true));
  

      !strstr($_SERVER["REQUEST_URI"],"admin") ? $this->register->insert_token($_POST["address"],$token) : $this->admin->admin_insert_token($_POST["address"],$token);

      $body = !strstr($_SERVER["REQUEST_URI"],"admin") ? "<a href='http://localhost/campsites/user/pass_reset_form.php?token=${token}'>http://localhost/campsites/user/pass_reset_form.php?token=${token}</a>" 
        
      : "<a href='http://localhost/campsites/admin/admin_pass_reset_form.php?token=${token}'>http://localhost/campsites/admin/admin_pass_reset_form.php?token=${token}</a>";

      mb_language("Japanese"); 
      mb_internal_encoding("UTF-8");
      mb_send_mail($email, $subject, $body,$header);

      $_SESSION["user"] = $user;

      // !strstr($_SERVER["REQUEST_URI"],"admin") ? header("location:pass_Reset.php") : header("location:admin_pass_reset_form.php");
      }else{
        return ["error"=>$error];
      }
  }

  
}

?>