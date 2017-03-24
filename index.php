<?php
error_reporting(E_ALL);
require_once 'http_request.php';
require_once 'database_handler.php';


$request = new Request("Haganeno-21124", "pc", "eu", "quickplay", "Zarya");
$request->sendRequest();
$res_json = $request->result();
//echo $res_json;

$dbhandler = new DatabaseHandler("localhost", "mydb", "root", "oth");

$a = array('b' => 12, 'a'=>1, 'c'=>2 );

foreach ($a as $key => $value) {
  //echo "Key: $key, Valeur: $value\n";
}
?>
