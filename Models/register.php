<?php
require_once(ROOT_PATH."/Models/Db.php");

class Register extends Db{
  public function __construct($dbh = null) 
  {
      parent:: __construct($dbh);
  }

  public function get_dbh() 
  {
    return $this->dbh;
  }

  public function UsersData($usersData = null) 
  {
    $password = password_hash($usersData["password"],PASSWORD_DEFAULT);
    $this->dbh->beginTransaction();
    try{
      $sql = 'INSERT INTO users(name,email,password) VALUES(:nickname,:user_id,:password)';
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(":nickname",$usersData["nickname"],PDO::PARAM_STR);
      $sth->bindParam(":user_id",$usersData["user_id"],PDO::PARAM_STR);
      $sth->bindParam(":password",$password,PDO::PARAM_STR);
      $sth->execute();
      $this->dbh->commit();
    }catch(PDOException $e) {
      echo "接続エラー".$e->getmessage();
      $this->dbh->rollback();
      exit();
    }
  }

  public function facilities() 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT * FROM facilities";
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "接続エラー".$e->getmessage();
      $this->dbh->rollback();
      exit();
    }
  }

  public function prefectures() 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT * FROM prefectures";
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "接続エラー".$e->getmessage();
      $this->dbh->rollback();
      exit();
    }
  }

  public function structures() 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT * FROM structures";
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "接続エラー".$e->getmessage();
      $this->dbh->rollback();
      exit();
    }
  }

  public function camp_faciilities($campsite_id = null,$facility_id = null) 
  {
    $sql = " INSERT INTO camp_facilities(campsite_id,facility_id) VALUES(:campsite_id,:facility_id)";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":campsite_id",$campsite_id,PDO::PARAM_INT);
    $sth->bindValue(":facility_id",$facility_id,PDO::PARAM_INT);
    $sth->execute();
  }

  public function camp_structures($campsite_id = null,$structure_id = null) 
  {
    $sql = " INSERT INTO camp_structures(campsite_id,structure_id) VALUES(:campsite_id,:structure_id)";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":campsite_id",$campsite_id,PDO::PARAM_INT);
    $sth->bindValue(":structure_id",$structure_id,PDO::PARAM_INT);
    $sth->execute();
  }

  public function campsite_upload($fileData = null,$campsite_Data = null) 
  {
    $sql = " INSERT INTO campsites(name,image,prefecture_id,address,tel,buisiness_hours,url) VALUES(:name,:image,:prefecture_id,:address,:tel,:buisiness_hours,:url)";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":name",$campsite_Data["name"],PDO::PARAM_STR);
    $sth->bindValue(":image",$fileData,PDO::PARAM_STR);
    $sth->bindValue(":prefecture_id",$campsite_Data["prefecture"],PDO::PARAM_INT);
    $sth->bindValue(":address",$campsite_Data["address"],PDO::PARAM_STR);
    $sth->bindValue(":tel",$campsite_Data["tel"],PDO::PARAM_INT);
    $sth->bindValue(":buisiness_hours",$campsite_Data["buisiness_hours"],PDO::PARAM_STR);
    $sth->bindValue(":url",$campsite_Data["url"],PDO::PARAM_STR);
    $sth->execute();
    return $this->dbh->lastInsertId();
  }

  public function edit_campsite($fileData = null,$campsite_Data = null)
  {
    $sql = " UPDATE campsites SET name = :name,image = :image,prefecture_id = :prefecture_id,address = :address,tel = :tel,buisiness_hours = :buisiness_hours,url = :url WHERE id = :id";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":name",$campsite_Data["name"],PDO::PARAM_STR);
    $sth->bindValue(":image",$fileData,PDO::PARAM_STR);
    $sth->bindValue(":prefecture_id",$campsite_Data["prefecture"],PDO::PARAM_INT);
    $sth->bindValue(":address",$campsite_Data["address"],PDO::PARAM_STR);
    $sth->bindValue(":tel",$campsite_Data["tel"],PDO::PARAM_INT);
    $sth->bindValue(":buisiness_hours",$campsite_Data["buisiness_hours"],PDO::PARAM_STR);
    $sth->bindValue(":url",$campsite_Data["url"],PDO::PARAM_STR);
    $sth->bindValue(":id",$campsite_Data["id"],PDO::PARAM_INT);
    $sth->execute();
  }

  

  public function insert_token($email,$token) 
  {
    $sql = " UPDATE users SET token = :token WHERE email = :email";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":token",$token,PDO::PARAM_STR);
    $sth->bindValue(":email",$email,PDO::PARAM_STR);
    $sth->execute();
    return $token;

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
    $sql = " SELECT token FROM users WHERE token = :token";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":token",$token);
    $sth->execute();
    return $sth->fetch(PDO::FETCH_COLUMN);
  }

  public function delete_facilities($campsite_id = null)
  {
    $sql = " DELETE FROM camp_facilities WHERE campsite_id = :campsite_id";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":campsite_id",$campsite_id,PDO::PARAM_INT);
    $sth->bindValue(":campsite_id",$campsite_id,PDO::PARAM_INT);
    $sth->execute();
  }
  public function delete_structures($campsite_id = null)
  {
    $sql = " DELETE FROM camp_structures WHERE campsite_id = :campsite_id";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":campsite_id",$campsite_id,PDO::PARAM_INT);
    $sth->execute();
  }

}

?>