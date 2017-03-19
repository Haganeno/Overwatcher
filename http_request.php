<?php
class Request {

private $battle_tag;
private $platform;
private $region;
private $mode;
private $hero;
private $arrContextOptions;
private $result;

public function __construct($_battle_tag, $_platform, $_region, $_mode, $_hero) {

    global $battle_tag, $platform, $region, $mode, $hero, $result, $arrContextOptions;
  $battle_tag = $_battle_tag;
  $pos = strpos($battle_tag, '#');
  if($pos != FALSE) {
    $battle_tag[$pos] = '-';
    $battle_tag = implode ('/', $battle_tag);
  }
  $platform = $_platform;
  $region = $_region;
  $mode = $_mode;
  $hero = $_hero;
  $result= "";
  $arrContextOptions=array(
      "ssl"=>array(
          "verify_peer"=>false,
          "verify_peer_name"=>false,
      ),
  );
  //echo $battle_tag; echo $platform; echo $region; echo $mode; echo $hero;
}

public function sendRequest() {
  global $battle_tag, $platform, $region, $mode, $hero, $result, $arrContextOptions;
  $url = 'https://api.lootbox.eu/';
  $url .= $platform;
  $url .= '/';
  $url .= $region;
  $url .= '/';
  $url .= $battle_tag;
  $url .= '/';
  $url .= $mode;
  if($mode == 'profile' || $mode == 'achievements') {
    $result = file_get_contents($url, false, stream_context_create($arrContextOptions));
  }
  else if ($hero == 'heroes') {
  $url .= '/';
  $url .= $hero;
  $result = file_get_contents($url, false, stream_context_create($arrContextOptions));
  }
  else if($hero == 'allHeroes') {
    $url .= '/';
    $url .= $hero;
    $url .= '/';
    $result = file_get_contents($url, false, stream_context_create($arrContextOptions));
  }
  else {
    $url .= '/hero/';
    $url .= $hero;
    $url .= '/';
    $result = file_get_contents($url, false, stream_context_create($arrContextOptions));

  }
  return $result;

}

public function battle_tag() {
  return $this->battle_tag;
}

public function platform() {
  return $this->platform;
}

public function region() {
  return $this->region;
}

public function mode() {
  return $this->mode;
}

public function result() {
  global $result;
  return $result;
}
 }?>
