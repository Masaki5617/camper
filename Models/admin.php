<?php
require_once(ROOT_PATH."/Models/Db.php");

class Admin extends Db{
  public function __construct($dbh = null) {
      parent:: __construct($dbh);
  }

  public function adminData($usersData = null) 
  {
    $password = password_hash($usersData["password"],PASSWORD_DEFAULT);
    $this->dbh->beginTransaction();
    try{
      $sql = 'INSERT INTO admin(email,password) VALUES(:email,:password)';
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(":email",$usersData["user_id"],PDO::PARAM_STR);
      $sth->bindParam(":password",$password,PDO::PARAM_STR);
      $sth->execute();
      $this->dbh->commit();
    }catch(PDOException $e) {
      echo "接続エラー".$e->getmessage();
      exit();
    }
  }
  
  public function get_user($email = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = "SELECT * FROM admin WHERE email = :email";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":email",$email);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
        $this->dbh->rollBack();
        exit();
    }
  }

  public function admin_update($usersData = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $password = password_hash($usersData["password"],PASSWORD_DEFAULT);
      $sql = " UPDATE admin SET password = :password WHERE token = :token ";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":password",$password,PASSWORD_DEFAULT);
      $sth->bindValue(":token",$usersData["token"]);
      $sth->execute();
      $this->dbh->commit();
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
        $this->dbh->rollBack();
        exit();
    }
  }

  public function admin_pass_Reset($array = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT * FROM admin WHERE email = :email";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":email",$array);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function admin_insert_token($email,$token)
  {
    $sql = " UPDATE admin SET token = :token WHERE email = :email";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":token",$token,PDO::PARAM_STR);
    $sth->bindValue(":email",$email,PDO::PARAM_STR);
    $sth->execute();
    return $token;
  }

  public function get_token($token = null)
  {
    $sql = " SELECT token FROM admin WHERE token = :token";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":token",$token);
    $sth->execute();
    return $sth->fetch(PDO::FETCH_COLUMN);
  }


}

?>