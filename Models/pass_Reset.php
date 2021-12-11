<?php

require_once(ROOT_PATH."Models/Db.php");

class pass_Reset extends Db{
  public function __construct($dbh = null){
    parent:: __construct($dbh);
  }

  public function pass_Reset($array = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT * FROM users WHERE email = :email";
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

}
?>