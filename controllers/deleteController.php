<?php

require_once(ROOT_PATH.'/Models/post.php');
require_once(ROOT_PATH.'/Models/campsites.php');

class deleteController {
  private $delete;
  private $campsite;

  public function __construct() 
  {
    $this->request["get"] = $_GET;
    $this->post = new post();
    $this->campsite = new Campsite();
  }

  public function delete_controll() 
  {
    $this->post->delete($this->request["get"]);
  }

  public function campsite_delete_controll()
  {
    $this->campsite->campsites_delete($this->request["get"]["id"]);
    $this->campsite->camp_facilities_delete($this->request["get"]["id"]);
    $this->campsite->camp_structures_delete($this->request["get"]["id"]);
  }

}

?>