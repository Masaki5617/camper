<?php


/**
 * このクラスは管理者のログインを行います。
 * 
 * DBに登録状況が確認できればログインさせます。
 */

 
require_once(ROOT_PATH.'/Models/admin.php');

class admin_loginControll {

  private $admin;

  public function __construct() {
    $this->request["post"] = $_POST;
    $this->admin = new Admin();
  }
 
  /**
   * バリデーション実行
   * ポスト送信でlogin_validateの実行
   * @return array $this->login_validate()
   */
  public function login_controll() {
    if(!empty($this->request["post"])) {
      return $this->login_validate();
    }else if(isset($_SESSION["admin"])) {
      $_SESSION = array();
    }
  }

  /**
   * 管理者情報の取得
   * @param string $email ポスト値のメールアドレス
   * @return array admin->get_user($email)
   */
  public function admin_get($email) {
    return $this->admin->get_user($email);
  }

  /**
   * 管理者ログインのバリデーション
   * ポストで来たらバリデーション発動
   * @return array ["error"=>$error]
   */
  public function login_validate() {
    $error = [];

    /**
     * 管理者情報を取得して変数に格納
     * @var array $login 取得出来れば管理者情報を、なければfalseが入る。
     */
    $login = $this->admin->get_user($_POST["user_id"]);
    
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
      $_SESSION["admin"] = $this->admin_get($_POST["user_id"]);
      header("location:../admin/admin_top.php");
      exit();
    }else{
      $_SESSION["form"] = $_POST;
      return ["error"=>$error];
    }

  }
}
?>