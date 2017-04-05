<?php

class DatabaseHandler {

  private $hostname;
  private $dbname;
  private $db;
  private $login;
  private $password;

  // requete et parsing initial pour remplir la BDD
  public function __construct($_hostname, $_dbname, $_login, $_password, $id, $platform, $region) {
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

    $mode = "profile";
    $hero = "";
    $request = new Request($id, $platform, $region, $mode, $hero);
    $request->sendRequest();
    $res_json = $request->result();
    $r = Parser::parse_profile($res_json);


    $mode = "competitive";
    $hero = "allHeroes";
    $request = new Request($id, $platform, $region, $mode, $hero);
    $request->sendRequest();
    $res_json = $request->result();
    $r2 = Parser::parse_allHeroes($res_json);

    $mode = "quickplay";
    $request = new Request($id, $platform, $region, $mode, $hero);
    $request->sendRequest();
    $res_json = $request->result();
    $r3 = Parser::parse_allHeroes($res_json);

    $quicktime = explode(" ", $r["playtimeQuick"]);
    $competitivetime = explode(" ", $r["playtimeCompetitive"]);

    $values = array('"'.$id.'"', '"'.$r["username"].'"', $r["level"],$r["rank"], $r["quickplayWins"],$r["competitiveWins"], '"'.$r["avatar"].'"', $r["competitiveLost"],$r["competitivePlayed"], $competitivetime[0], $quicktime[0], $r2["Eliminations-Average"], $r2["Deaths-Average"], $r3["Eliminations-Average"], $r3["Deaths-Average"]);

    $query = "INSERT INTO User(idUser,userName,Level,Rank,QuickWins,RankedWins,Icon,RankedLost,RankedPlayed,RankedTime,QuickTime,RankedKillsAvg,RankedDeathsAvg,QuickKillsAvg,QuickDeathsAvg) VALUES(";

    foreach($values as $v){
      $query .= $v.",";
    }
    $query = substr($query, 0, -1);
    $query .=")";
    $db->exec($query);
    echo $query;
  }
}

 ?>
