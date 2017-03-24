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
  $this->battle_tag = $_battle_tag;
  $pos = strpos($this->battle_tag, '#');
  if($pos != FALSE) {
    $this->battle_tag[$pos] = '-';
    $this->battle_tag = implode ('/', $this->battle_tag);
  }
  $this->platform = $_platform;
  $this->region = $_region;
  $this->mode = $_mode;
  $this->hero = $_hero;
  $this->result= "";
  $this->arrContextOptions=array(
      "ssl"=>array(
          "verify_peer"=>false,
          "verify_peer_name"=>false,
      ),
  );
  //echo $this->battle_tag; echo $this->platform; echo $this->region; echo $mode; echo $this->hero;
}

public function sendRequest() {
  $url = 'https://api.lootbox.eu/';
  $url .= $this->platform;
  $url .= '/';
  $url .= $this->region;
  $url .= '/';
  $url .= $this->battle_tag;
  $url .= '/';
  $url .= $this->mode;

  if($this->mode == 'profile' || $this->mode == 'achievements') {
    $this->result = file_get_contents($url, false, stream_context_create($this->arrContextOptions));
  }
  else if ($this->hero == 'heroes') {
  $url .= '/';
  $url .= $this->hero;
  $this->result = file_get_contents($url, false, stream_context_create($this->arrContextOptions));
  }
  else if($this->hero == 'allHeroes') {
    $url .= '/';
    $url .= $this->hero;
    $url .= '/';
    $this->result = file_get_contents($url, false, stream_context_create($this->arrContextOptions));
  }
  else {
    $url .= '/hero/';
    $url .= $this->hero;
    $url .= '/';
    $this->result = file_get_contents($url, false, stream_context_create($this->arrContextOptions));

  }
  return $this->result;

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
  return $this->result;
}
 }?>
