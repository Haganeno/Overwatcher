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

    $db->query("INSERT INTO user(idUser, userName, rankLevel, skillRating) VALUES(01,'Haganeno-21124', 200, 3000)");
    $db->query("INSERT INTO user(idUser, userName, rankLevel, skillRating) VALUES(02,'Haganeno-21124', 210, 3000)");

    $db->query("INSERT INTO user(idUser, userName, rankLevel, skillRating) VALUES(03,'Haganeno-21124', 4100, 3000)");

    $r = $db->query("SELECT * FROM user");
    while($data = $r->fetch()) {
      echo 'tag='.$data["userName"]." rank=".$data["rankLevel"]." SR=".$data["skillRating"]."<br>";
    }
  }

  public function getDatabse() {
    return $this->db;
  }



}

 ?>
