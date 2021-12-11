<?php
require_once(ROOT_PATH."/Models/Db.php");

class Campsite extends Db{

  const LOOP_START = 1;
  const FIRST_DATA = 1;
  public function __construct($dbh = null) {
      parent:: __construct($dbh);
  }

  public function get_facilities() 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = $this->get_sql_for_facilityName();
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
        $this->dbh->rollBack();
        exit();
    }
  }

  public function get_structures() 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = $this->get_sql_for_structureName();
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }
  
  public function search_get_facilities($datas = null)
  {
    $this->dbh->beginTransaction();
    try{
      $inSql = '(';
      $i = self::LOOP_START;
      foreach($datas as $data) {
        $inSql .= $i == self::FIRST_DATA ? $data['id'] : ','.$data['id'];
        $i++;
      }
      $inSql .= ')';
      $sql = $this->get_sql_for_facilityName();
      $sql.= " WHERE c.campsite_id IN ${inSql}";
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function search_get_structures($datas = null)
  {
    $this->dbh->beginTransaction();
    try{
      $inSql = '(';
      $i = self::LOOP_START;
      foreach($datas as $data) {
        $inSql .= $i == 1 ? $data['id'] : ','.$data['id'];
        $i++;
      }
      $inSql .= ')';
  
      $sql = $this->get_sql_for_structureName();
      $sql.= " WHERE c.campsite_id IN ${inSql}";
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  
  public function get_campsite() 
  {
    $this->dbh->beginTransaction();
    try{
      $sql =" SELECT c.id,c.name,c.image,p.name AS prefecture FROM campsites c JOIN prefectures p ON c.prefecture_id = p.id";
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function edit_get_campsite($campsite_id =null) 
  {
    $sql = $this->edit_get_campsites();
    $sql.= " WHERE c.id = :campsite_id";
    $sth = $this->dbh->prepare($sql);
    $sth->bindValue(":campsite_id",$campsite_id,PDO::PARAM_INT);
    $sth->execute();
    return $sth->fetch(PDO::FETCH_ASSOC);
  }

  public function get_detail($detail = null) 
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT id,name,image,address,tel,buisiness_hours,url FROM campsites WHERE id = :id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":id",$detail["id"]);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
  }

  public function search($category = null)
  {
    $this->dbh->beginTransaction();
    try{
      $sql = " SELECT DISTINCT c.image,c.name,c.id,p.name AS prefecture FROM campsites c JOIN camp_facilities cf ON c.id = cf.campsite_id JOIN camp_structures cs ON c.id = cs.campsite_id JOIN facilities f ON cf.facility_id = f.id JOIN structures s ON cs.structure_id = s.id JOIN prefectures p ON c.prefecture_id = p.id WHERE prefecture_id = :prefecture_id AND (";
      $this->makeWhere($sql, $category['facilities'], 'facility_id', 'f');
      $this->makeWhere($sql, $category['structures'], 'structure_id', 's',true);
      $sql.= ")";
      $sth =$this->dbh->prepare($sql);
      $sth = $this->makeBind('facility_id', $category['facilities'], $sth);
      $sth = $this->makeBind('structure_id', $category['structures'], $sth);
      $sth->bindValue(":prefecture_id",$category["prefecture"],PDO::PARAM_INT);
      $sth->execute();
      $this->dbh->commit();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "sqlエラー:".$e->getMessage();
      $this->dbh->rollBack();
      exit();
    }
    }

    private function makeWhere(&$sql, $ids, $column, $alias,$continue = false)
    {
      if($continue) $sql.= " OR";
      $i =  self::LOOP_START;
      foreach($ids as $key=>$id) {
        $bind = $column.$i;
        $sql.= " ${alias}.id = :${bind}";
        $i++;
        if($key !== array_key_last($ids)) $sql.= " OR" ;  
      }
    }

    private function makeBind($column, $datas, $sth)
    {
      $i =  self::LOOP_START;
      foreach( $datas as $data) {
        $bind = $column.$i;
        $sth->bindValue(":${bind}", 1, PDO::PARAM_INT);
        $i++;
      }
      return $sth;
    }

    public function edit_get_campsites()
    {
      return " SELECT c.id,c.name,c.address,c.tel,c.buisiness_hours,c.url,c.image,p.name AS prefecture FROM campsites c JOIN prefectures p ON c.prefecture_id = p.id";
    }
    public function get_sql_for_facilityName()
    {
      return " SELECT c.campsite_id,f.name FROM camp_facilities c JOIN facilities f ON c.facility_id = f.id";
    }

    public function get_sql_for_structureName()
    {
      return " SELECT c.campsite_id,s.name FROM camp_structures c JOIN structures s ON c.structure_id = s.id";
    }



    public function edit_get_facilities($campsite_id = null)
    {
      $sql = $this->get_sql_for_facilityName();
      $sql.= " WHERE c.campsite_id = :campsite_id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":campsite_id",$campsite_id,PDO::PARAM_INT);
      $sth->execute();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function edit_get_structures($campsite_id = null)
    {
      $sql = $this->get_sql_for_structureName();
      $sql.= " WHERE c.campsite_id = :campsite_id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":campsite_id",$campsite_id,PDO::PARAM_INT);
      $sth->execute();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function campsites_delete($campsite_id)
    {
      $sql = " DELETE FROM campsites WHERE id = :id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":id",$campsite_id,PDO::PARAM_INT);
      $sth->execute();
    }
    public function camp_facilities_delete($campsite_id)
    {
      $sql = " DELETE FROM camp_facilities WHERE campsite_id = :campsite_id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":campsite_id",$campsite_id,PDO::PARAM_INT);
      $sth->execute();
    }
    public function camp_structures_delete($campsite_id)
    {
      $sql = " DELETE FROM camp_structures WHERE campsite_id = :campsite_id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(":campsite_id",$campsite_id,PDO::PARAM_INT);
      $sth->execute();
    }

}





