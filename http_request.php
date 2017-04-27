<?php


class Request {

private $battle_tag;
private $platform;
private $mode;
private $hero;
private $arrContextOptions;
private $result;

// Initialisation des parametres de la requete
public function __construct($_battle_tag, $_platform, $_mode) {
  $this->battle_tag = $_battle_tag;

  // Transforme le "#" d'un battle tag par un "-"
  $pos = strpos($this->battle_tag, '#');
  if($pos != FALSE) {
    $this->battle_tag[$pos] = '-';
    $this->battle_tag = implode ('/', $this->battle_tag);
  }
  $this->platform = $_platform;
  $this->mode = $_mode;
  $this->result= "";


  // Option de la requete HTTP
  $this->arrContextOptions=array(
      "ssl"=>array(
          "verify_peer"=>false,
          "verify_peer_name"=>false,
      ),
  );
}

// Envoi de la requete en utilisant cURL
public function sendRequest() {
    $url = self::url();
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Overwatcher');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $this->result = curl_exec($curl);
    curl_close($curl);
    return $this->result;
}

// Forme l'url avec les parametres reçus
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
?>
