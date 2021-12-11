<?php

require_once(ROOT_PATH."Models/Db.php");

class post extends Db{
  public function __construct($dbh = null)
  {
    parent:: __construct($dbh);
  }

  public function insert_post($campsite_id = null,$post = null,$user_id = null) 
  {
    
    $this->dbh->beginTransaction();
    try{
      $sql = " INSERT INTO posts(user_id,campsite_id,title,review,score) VALUES(:user_id,:campsite_id,:title,:review,:score)";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":user_id",$user_id["id"],PDO::PARAM_INT);
      $sth->bindValue(":campsite_id",$campsite_id["id"],PDO::PARAM_INT);
      $sth->bindValue(":title",$post["title"],PDO::PARAM_STR);
      $sth->bindValue(":review",$post["review"],PDO::PARAM_STR);
      $sth->bindValue(":score",$post["score"],PDO::PARAM_STR);
      $sth->execute();
      $this->dbh->commit();
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function get_post($id = null)
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT p.id,p.campsite_id,p.user_id,u.name,p.title,p.review,p.score FROM posts p JOIN users u ON p.user_id = u.id WHERE p.campsite_id = :id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":id",$id["id"],PDO::PARAM_INT);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function get_campsite_id($id = null)
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT id FROM campsites WHERE id = :id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":id",$id["id"],PDO::PARAM_INT);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function delete($id = null)
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " DELETE FROM posts WHERE user_id = :user_id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":user_id",$id["id"],PDO::PARAM_INT);
      $sth->execute();
      $this->dbh->commit();
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function getAll_post($campsite_id = null,$user_id = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT EXISTS(SELECT * FROM posts WHERE user_id =:user_id AND campsite_id = :campsite_id) ";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":user_id",$user_id,PDO::PARAM_INT);
      $sth->bindValue(":campsite_id",$campsite_id["id"],PDO::PARAM_INT);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function post_update($post = null,$user_id = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " UPDATE posts SET title = :title,review = :review,score = :score WHERE user_id = :user_id ";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":title",$post["title"],PDO::PARAM_STR);
      $sth->bindValue(":review",$post["review"],PDO::PARAM_STR);
      $sth->bindValue(":user_id",$user_id["id"],PDO::PARAM_STR);
      $sth->bindValue(":score",$post["score"],PDO::PARAM_STR);
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