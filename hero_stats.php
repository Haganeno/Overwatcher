<?php
error_reporting(E_ALL);
class HeroStats{
  private $heroName;  
  private $stats;

  //Constructeur par défaut de la classe
  public function _construct(){
    $this->heroName = "";
    $this->stats = array();
  }

  public function setHeroName($_heroName){
    $this->heroName = $_heroName;
  }

  public function getHeroName(){
    return $this->heroName;
  }
  
  public function setValue($_key, $_value){
  	$this->stats[$_key]=$_value;
  }
  
  public function getValue($_key){
  	return $this->stats[$_key];
  }
}
