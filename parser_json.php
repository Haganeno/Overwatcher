<?php
error_reporting(E_ALL);
class Parser {
  public static function parse($json){
  	$json_data = json_decode($json, true);
  	$return = array();
  	$account_list = array();
  	$overall_stats = array();
  	$game_stats = array();
  	$average_stats = array();
  	$hero_stats = array();
  	$playtime = array();
  	$achievements = array();
  	foreach($json_data as $account => $value){
  		if($account != "_request" && $account != "any"){
  			$account_list[$account] = true;
  			foreach($value as $request = $val){
  				if($request == "stats"){
  					foreach($val as $mode => $res){
  						foreach($res as $type => $data){
  							foreach($data as $title => $number){
  								switch($type){
  								case "overall_stats":
  									$overall_stats[$mode][$title]=$number;
  									break;
  								case "game_stats":
  									$game_stats[$mode][$title]=$number;
  									break;
  								case "average_stats":
  									$average_stats[$mode][$title]=$number;
  									break;
  								case:"competitive":
  									break;
  								}
  							}
  						}
  					}
  				}
  				else if ($request = "heroes"){
  					foreach($val as $stat_or_playtime => $res){
  						foreach($res as $mode => $name){
  							if($stat_or_playtime == "stats"){
  								foreach($name as $general_or_specific => $data){
  									foreach($data as $title => $number){
  										$hero_stats[$name][$mode]=$number;
  									}
                   }
  							}else { //Playtime
  								foreach($name as $hero_data => $number){
  									$playtime[$name][$mode] = $number;
  								}
  							}
  						}
  					}
  				}else { //Achievements
  					foreach($val as $type => $var){
  						foreach($var as $title => $bool){
  							$achievements[$title] = $bool;
  						}
  					}
  				}
  			}
  		}
  	}

  	$return["accounts"] = $account_list;
  	$return["game_stats"] = $game_stats;
  	$return["average_stats"] = $average_stats;
  	$return["heroes_stats"] = $hero_stats;
  	$return["playtime"] = $playtime;
  	$return["achievement_list"] = $achievements;
  	return $return;
  }
}
