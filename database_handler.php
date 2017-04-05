<?php

class DatabaseHandler {

  private $hostname;
  private $dbname;
  private $db;
  private $login;
  private $password;
  public function __construct($_hostname, $_dbname, $_login, $_password) {
    $this->hostname = $_hostname;
    $this->dbname = $_dbname;
    $this->login = $_login;
    $this->password = $_password;
    try {
      $db = new PDO('mysql:host='.$this->hostname.':3306;dbname='.$this->dbname.';charset=utf8', $this->login, $this->password);
    }
    catch (Exception $e) {
      die("Error : ".$e->getMessage());
    }
  }

  public function insert($table, $data) {
    $query = sprintf("INSERT INTO ".$table.' (%s) VALUES ("%s")', implode(",", array_keys($data)), implode('","', array_values($data)));
    echo $query;
    $db->query($query);
  }
/*
    $r = $db->query("SELECT * FROM user");
    while($data = $r->fetch()) {
      echo 'tag='.$data["userName"]." rank=".$data["rankLevel"]." SR=".$data["skillRating"]."<br>";
    }
  }*/


  public function getDatabse() {
    return $this->db;
  }



}

 ?>
