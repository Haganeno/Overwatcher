<?php
error_reporting(E_ALL);
class Achievement{
  private $name;  
  private $finished;
  private $image;
  private $description;

  //Constructeur par défaut de la classe
  public function _construct(){
    $this->name = "";
    $this->finished = false;
    $this->image = "";
    $this->description = "";
  }

	public function setName($_name){
		$this->name = $_name;
	}

	public function getName(){
		return $this->name;
	}
 	
 	public function setFinished($_finished){
 		$this->finished = $_finished;
 	}
 	
 	public function getFinished(){
 		return $this->finished;
 	}
 	
 	public function setImage($_image){
 		$this->image = $_image;
 	}
 	
 	public function getImage(){
 		return $this->image;
 	}
 	
 	public function setDescription($_description){
 		$this->description = $_description;
 	}
 	
 	public function getDescription(){
 		return $this->description;
 	}
 	
 	public function toString(){
 		return "".$this->name.", finished = ".$this->finished." : ".$this->description;
 	}
}
