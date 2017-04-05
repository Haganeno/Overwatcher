<?php
error_reporting(E_ALL);
require_once 'http_request.php';
require_once 'parser_json.php';
require_once 'database_handler.php';

$dbhandler = new DatabaseHandler("localhost", "mydb", "root", "oth", "Haganeno-21124", "pc", "eu");
?>
