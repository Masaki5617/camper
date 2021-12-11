<?php
require_once(ROOT_PATH."/Models/Db.php");

class Reset extends Db{
  public function __construct($dbh = null) {
      parent:: __construct($dbh);
  }
  
  public function update($usersData = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $password = password_hash($usersData["password"],PASSWORD_DEFAULT);
      $sql = " UPDATE users SET password = :password WHERE token = :token ";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":password",$password,PDO::PARAM_STR);
      $sth->bindValue(":token",$usersData["token"]);
      $sth->execute();
      $this->dbh->commit();
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  

}

?>