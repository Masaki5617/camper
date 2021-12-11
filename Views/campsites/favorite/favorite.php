<?php

require_once(ROOT_PATH."controllers/favoriteController.php");

$favorite = new favoriteController();
$isfavorite = $favorite->favorite_controll();
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($isfavorite);
?>