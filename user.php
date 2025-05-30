<?php

require_once('database.php');

Class User {

  public function get_all_users(){
    $dh = db_connect();
    $statement = $dh->prepare("SELECT * FROM users");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }
  
}