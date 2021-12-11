<?php
require_once(ROOT_PATH."/Models/Db.php");

class favorite extends Db{
  public function __construct($dbh = null) {
      parent:: __construct($dbh);
  }

  public function get_favorite($data = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT id FROM favorite WHERE user_id = :user_id AND campsite_id = :campsite_id ";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":user_id",$data["user_id"],PDO::PARAM_INT);
      $sth->bindValue(":campsite_id",$data["campsite_id"],PDO::PARAM_INT);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetch(PDO::FETCH_COLUMN);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function insert_favorite($favorite = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " INSERT INTO favorite(user_id,campsite_id) VALUES(:user_id,:campsite_id)";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":user_id",$favorite["user_id"],PDO::PARAM_INT);
      $sth->bindValue(":campsite_id",$favorite["campsite_id"],PDO::PARAM_INT);
      $sth->execute();
      $this->dbh->commit();
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function delete_favorite($data = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " DELETE FROM favorite WHERE user_id = :user_id AND campsite_id = :campsite_id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":user_id",$data["user_id"],PDO::PARAM_INT);
      $sth->bindValue(":campsite_id",$data["campsite_id"],PDO::PARAM_INT);
      $sth->execute();
      $this->dbh->commit();
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }
  
}
