<?php

class DatabaseHandler {

  private $hostname;
  private $dbname;
  private $db;
  private $login;
  private $password;

  // requete et parsing initial pour remplir la BDD
  public function __construct($_hostname, $_dbname, $_login, $_password, $id, $platform) {
    $this->hostname = $_hostname;
    $this->dbname = $_dbname;
    $this->login = $_login;
    $this->password = $_password;
    try {
      $db = new PDO('mysql:host='.$this->hostname.';dbname='.$this->dbname.';charset=utf8', $this->login, $this->password);
    }
    catch (Exception $e) {
      die("Error : ".$e->getMessage());
    }

    // valeurs du compte du joueur dont on veut récupérer les stats
    $id = "Haganeno-21124";
    $platform = "pc";
    $mode = "stats";
    $request = new Request($id, $platform, $mode); // creation de la requete
    $result = $request->sendRequest(); // envoie de la requete
    $parsed = Parser::parse($result); // parse de la requete

    //echo '<pre>' . var_export(array_keys($parsed), true) . '</pre>';
    //echo '<pre>' . var_export($parsed, true) . '</pre>';

    // stats en mode partie rapide
    $quickplay = $parsed["overall_stats"]["quickplay"];
    $quickplay_stats = $parsed["game_stats"]["quickplay"];
    $quickplay_average = $parsed["average_stats"]["quickplay"];

    // pseudo et niveau du joueur
    $username = explode("-", $id);
    $player_level = $quickplay["prestige"] * 100 + $quickplay["level"];

    // si le joueur a fait des parties competitives on ajoute les données correspondantes
    // sinon on les met à null
    if($parsed["competitive"] == true) {
      $competitive_overall = $parsed["overall_stats"]["competitive"];
      $competitive_stats = $parsed["game_stats"]["competitive"];
      $competitive_average = $parsed["average_stats"]["competitive"];
      // creation du tableau de valeurs à ajouter à la requete SQL
      $values = array('"'.$id.'"', '"'.$username[0].'"', $player_level, $competitive_overall["comprank"], $quickplay["wins"],$competitive_overall["wins"], '"'.$quickplay["avatar"].'"', $competitive_overall["losses"], $competitive_overall["games"], $competitive_stats["time_played"], $quickplay_stats["time_played"], $competitive_average["eliminations_avg"], $competitive_average["deaths_avg"], $quickplay_average["eliminations_avg"], $quickplay_average["deaths_avg"]);
    }
    else {
      // creation du tableau de valeurs (sans l'aspect competitif) à ajouter à la requete SQL
      $values = array('"'.$id.'"', '"'.$username[0].'"', $player_level, null, $quickplay["wins"], null, '"'.$quickplay["avatar"].'"', null, null, null, $quickplay_stats["time_played"], null, null, $quickplay_average["eliminations_avg"], $quickplay_average["deaths_avg"]);

    }

    // creation de la requete SQL
    $query = "INSERT INTO User(idUser,userName,Level,Rank,QuickWins,RankedWins,Icon,RankedLost,RankedPlayed,RankedTime,QuickTime,RankedKillsAvg,RankedDeathsAvg,QuickKillsAvg,QuickDeathsAvg) VALUES(";

    // boucle d'ajout des valeurs à la requete SQL
    foreach($values as $v){
      if($v == null) { // met à null les valeurs SQL
        $query .= "null".",";
      }
      else $query .= $v.",";  // ajoute les valeurs à la requete SQL
    }

    // remplace la derniere virgule (en trop), par la parenthèse de fin de requete SQL
    $query = substr($query, 0, -1);
    $query .=")";

    // execution de la requete
    $db->exec($query);
    //echo $query;

  }
}

 ?>
