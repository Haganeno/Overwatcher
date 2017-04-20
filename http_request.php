<?php


class Request {

private $battle_tag;
private $platform;
private $mode;
private $hero;
private $arrContextOptions;
private $result;

public function __construct($_battle_tag, $_platform, $_mode) {
  $this->battle_tag = $_battle_tag;
  $pos = strpos($this->battle_tag, '#');
  if($pos != FALSE) {
    $this->battle_tag[$pos] = '-';
    $this->battle_tag = implode ('/', $this->battle_tag);
  }
  $this->platform = $_platform;
  $this->mode = $_mode;
  $this->result= "";



  $this->arrContextOptions=array(
      "ssl"=>array(
          "verify_peer"=>false,
          "verify_peer_name"=>false,
      ),
  );
}

public function sendRequest() {
    $url = self::url();
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Overwatcher');
    $this->result = curl_exec($curl);
    curl_close($curl);
    return $this->result;
}

public function url() {
  $url = 'https://owapi.net/api/v3/u/';
  $url .= $this->battle_tag;
  $url .= '/';
  $url .= $this->mode;
  $url .= '?platform=';
  $url .= $this->platform;
  return $url;
}

public function battle_tag() {
  return $this->battle_tag;
}

public function platform() {
  return $this->platform;
}

public function mode() {
  return $this->mode;
}

public function result() {
  return $this->result;
}
 }


/*class Request {

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
}

public function sendRequest() {
  if($this->mode == 'profile' || $this->mode == 'achievements') {
    $url = self::shortUrl();
    $this->result = file_get_contents($url, false, stream_context_create($this->arrContextOptions));
  }

  else if ($this->hero == 'heroes') {
  $url = self::heroesUrl($this->hero);
  $this->result = file_get_contents($url, false, stream_context_create($this->arrContextOptions));
  }
  else if($this->hero == 'allHeroes') {
    $url = self::heroesUrl($this->hero);
    $url .= '/';
    $this->result = file_get_contents($url, false, stream_context_create($this->arrContextOptions));
  }
  else {
    $url = self::heroesUrl("hero/");
    $url .= $this->hero;
    $url .= '/';
    $this->result = file_get_contents($url, false, stream_context_create($this->arrContextOptions));

  }
  return $this->result;

}

public function shortUrl() {
  $url = 'https://api.lootbox.eu/';
  $url .= $this->platform;
  $url .= '/';
  $url .= $this->region;
  $url .= '/';
  $url .= $this->battle_tag;
  $url .= '/';
  $url .= $this->mode;
  return $url;
}

public function heroesUrl($h_name) {
  $url = 'https://api.lootbox.eu/';
  $url .= $this->platform;
  $url .= '/';
  $url .= $this->region;
  $url .= '/';
  $url .= $this->battle_tag;
  $url .= '/';
  $url .= $this->mode;
  $url .= '/';
  $url .= $h_name;
  return $url;
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
 }*/?>
