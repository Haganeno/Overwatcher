<!DOCTYPE html>
<html>
<body>

<?php
include 'http_request.php';

$request = new Request("Haganeno-21124", "pc", "eu", "quickplay", "Zarya");
$request->sendRequest();
$res_json = $request->result();
echo $res_json;
?>

</body>
</html>
