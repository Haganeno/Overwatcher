<?php
error_reporting(E_ALL);
require_once 'http_request.php';
require_once 'parser_json.php';
require_once 'database_handler.php';



$request = new Request("Haganeno-21124", "pc", "eu", "quickplay", "Zarya");
$request->sendRequest();
$res_json = $request->result();
//echo $res_json;
$r = Parser::parse_hero($res_json);
foreach ($r as $key => $value) {
  foreach($value->getStats() as $k => $v) {
    echo "k = $k, v = $v \n";

  }
}

$dbhandler = new DatabaseHandler("localhost", "mydb", "root", "oth");



?>
