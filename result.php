<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="static/main.css">
  <link rel="icon" type="image/png" sizes="128x128" href="static/favicon.png">
  <title>Overwatch Design</title>
</head>
<body>
  <aside id="menu">
    <section id="search_form">
      <form name="search" id="search" method="post" action="/result.php">
      <?php
      	require_once "parser_json.php";
      	require_once "http_request.php";
      	$request = new Request("{$_POST["tag"]}", "pc", "blob");
      	$request_result = $request->sendRequest();
      	$result = Parser::parse($request_result); //Récupération de la réponse JSON
      ?>
        <fieldset id="pick_user">
          <h1>Choose a player</h1>
          <input type="text" name="tag" placeholder="e.g. Username-1234" title="e.g. Username-1234" pattern="\w+[-]\d+" maxlength="20"
            autocomplete="off" required autofocus>
          <select name="platform">
            <option value="pc">PC</option>
            <option value="psn">PlayStation</option>
            <option value="xbl">Xbox</option>
          </select>
          <h1>What are you looking for?</h1>
          <select name="query">
            <option value="achievements">Achievements</option>
            <option value="stats">Player stats</option>
            <option value="heroes">Hero stats</option>
          </select>
        </fieldset>
        <fieldset id="pick_mode" disabled>
          <h1>Pick a mode</h1>
          <select name="mode">
            <option value="quick">Quick play</option>
            <option value="competitive">Competitive play</option>
          </select>
        </fieldset>
        <fieldset id="pick_heroes" disabled>
          <h1>Select your heroes</h1>
          <div id="hero_icons">
            <label class="hero_icon"><input type="checkbox" name="ana"><img src="static/icons/ana.png" alt="Ana"></label>
            <label class="hero_icon"><input type="checkbox" name="bastion"><img src="static/icons/bastion.png" alt="Bastion"></label>
            <label class="hero_icon"><input type="checkbox" name="dva"><img src="static/icons/dva.png" alt="D.Va"></label>
            <label class="hero_icon"><input type="checkbox" name="genji"><img src="static/icons/genji.png" alt="Genji"></label>
            <label class="hero_icon"><input type="checkbox" name="hanzo"><img src="static/icons/hanzo.png" alt="Hanzo"></label>
            <label class="hero_icon"><input type="checkbox" name="junkrat"><img src="static/icons/junkrat.png" alt="Junkrat"></label>
            <label class="hero_icon"><input type="checkbox" name="lucio"><img src="static/icons/lucio.png" alt="Lúcio"></label>
            <label class="hero_icon"><input type="checkbox" name="mccree"><img src="static/icons/mccree.png" alt="McCree"></label>
            <label class="hero_icon"><input type="checkbox" name="mei"><img src="static/icons/mei.png" alt="Mei"></label>
            <label class="hero_icon"><input type="checkbox" name="mercy"><img src="static/icons/mercy.png" alt="Mercy"></label>
            <label class="hero_icon"><input type="checkbox" name="pharah"><img src="static/icons/pharah.png" alt="Pharah"></label>
            <label class="hero_icon"><input type="checkbox" name="reaper"><img src="static/icons/reaper.png" alt="Reaper"></label>
            <label class="hero_icon"><input type="checkbox" name="reinhardt"><img src="static/icons/reinhardt.png" alt="Reinhardt"></label>
            <label class="hero_icon"><input type="checkbox" name="roadhog"><img src="static/icons/roadhog.png" alt="Roadhog"></label>
            <label class="hero_icon"><input type="checkbox" name="soldier76"><img src="static/icons/soldier76.png" alt="Soldier: 76"></label>
            <label class="hero_icon"><input type="checkbox" name="sombra"><img src="static/icons/sombra.png" alt="Sombra"></label>
            <label class="hero_icon"><input type="checkbox" name="symmetra"><img src="static/icons/symmetra.png" alt="Symmetra"></label>
            <label class="hero_icon"><input type="checkbox" name="torbjorn"><img src="static/icons/torbjorn.png" alt="Torbjörn"></label>
            <label class="hero_icon"><input type="checkbox" name="tracer"><img src="static/icons/tracer.png" alt="Tracer"></label>
            <label class="hero_icon"><input type="checkbox" name="widowmaker"><img src="static/icons/widowmaker.png" alt="Widowmaker"></label>
            <label class="hero_icon"><input type="checkbox" name="winston"><img src="static/icons/winston.png" alt="Winston"></label>
            <label class="hero_icon"><input type="checkbox" name="zarya"><img src="static/icons/zarya.png" alt="Zarya"></label>
            <label class="hero_icon"><input type="checkbox" name="zenyatta"><img src="static/icons/zenyatta.png" alt="Zenyatta"></label>
          </div>
        </fieldset>
      </form>
    </section>
    <section id="search_button">
      <input type="submit" form="search" value="Ready?" disabled>
    </section>
  </aside>
  <main>
    <?php
	echo '<section class="player">';
	$overall = $result["overall_stats"]; //Affichage des informations du compte en bannière
	echo "<img class=\"avatar\" src=\"{$overall["quickplay"]["avatar"]}\" alt=\"Avatar\">";
        $tag = $_POST["tag"];
        $username = explode("-", $tag);
      	echo "<p class=\"username\">{$username[0]}</p>";
	echo "<div class=\"level\" style=\"background-image: url({$overall["quickplay"]["rank_image"]})\">";
	$lvl = $overall["quickplay"]["level"];
	$prestige = $overall["quickplay"]["prestige"];
	$level = $prestige*100 + $lvl;
        $tier = $overall["quickplay"]["tier"];
	echo "<p>$level</p>";
	echo "</div>";
	echo '<div class="rank">';
	echo '<img src="static/rank_icons/'.$tier.'.png" alt="Rank">';
        echo "<p>{$overall["quickplay"]["comprank"]}</p>";
	echo "</div></section>";
	//Affichage des statistiques du joueur, onglet Player Stats  
	if($_POST["query"]=="stats"){
		echo '<section class="stats"><table>';
	    	echo '<tr><th colspan="2">Quickplay Average</th></tr>';
		$average = $result["average_stats"];
		foreach($average["quickplay"] as $key => $value){
			$pretty_string = ucwords(str_replace("_"," ",$key));
			echo"<tr><td>$pretty_string</td><td>$value</td></tr>";
		}
		echo '<tr><th colspan="2">Competitive Average</th></tr>';
		foreach($average["competitive"] as $key => $value){
			$pretty_string = ucwords(str_replace("_"," ",$key));
			echo"<tr><td>$pretty_string</td><td>$value</td></tr>";
		}
		echo '<tr><th colspan="2">Quickplay Game Stats</th></tr>';
		$game_stats = $result["game_stats"];
		foreach($game_stats["quickplay"] as $key => $value){
			$pretty_string = ucwords(str_replace("_"," ",$key));
			echo"<tr><td>$pretty_string</td><td>$value</td></tr>";
		}
		echo '<tr><th colspan="2">Competitive Game Stats</th></tr>';
		$game_stats = $result["game_stats"];
		foreach($game_stats["competitive"] as $key => $value){
			$pretty_string = ucwords(str_replace("_"," ",$key));
			echo"<tr><td>$pretty_string</td><td>$value</td></tr>";
		}
		echo' </table></section>';
		//Affichage du temps de jeu
		echo '<section class="playtime">';
		$playtime = $result["playtime"];
		$max_time = 1; //On conserve le temps de jeu max pour faire un pourcentage facile à afficher
		$compt = 1; //Vérifie si on a déjà enregistré un temps de jeu max
		arsort($playtime["competitive"]); //Trier le tableau par ordre décroissant
		arsort($playtime["quickplay"]);
		foreach($playtime as $mode => $hero_data){
			if($mode == "competitive"){
				echo '<h1 align:left>Playtime Competitive</h1>';
				foreach($hero_data as $name => $time){
					if($compt == 1){
						$compt = 0;
						$max_time = $playtime[$mode][$name];
					}
					$percent = 100*$playtime[$mode][$name]/$max_time;
					if($percent >1){ //Les héros très peu joué ne sont pas affichés
						$format = number_format($percent,2);
						echo "<div class=\"playtime_bar\" style=\"width: {$percent}%\">{$name}: {$format}%</div>";
					}
				}
				$compt = 1;
				echo '<br>';
			}else{ //Quickplay
				arsort($playtime["quickplay"]);
				echo '<h1 align:left>Playtime Quickplay</h1>';
				foreach($hero_data as $name => $time){
					if($compt == 1){
						$compt = 0;
						$max_time = $playtime[$mode][$name];
					}
					$percent = 100*$playtime[$mode][$name]/$max_time;
					if($percent >1){
						$format = number_format($percent,2);
						echo "<div class=\"playtime_bar\" style=\"width: {$percent}%\">{$name}: {$format}%</div>";
					}
				}
			}
		}
		echo '</section>';
	//Affichage des statistiques par héro	
    	}else if($_POST["query"]=="heroes"){
    		$competitive_stats = $result["competitive_heroes_stats"];
    		$quickplay_stats = $result["quickplay_heroes_stats"];
    		echo'<section class=heroes><table>';
    		if($_POST["mode"]=="competitive"){
    			echo '<tr><th colspan="2">Competitive Stats</th></tr>';
    			foreach($competitive_stats as $hero_name => $stats){
    				if(array_key_exists($hero_name,$_POST)){ //Si le héro a été choisi lors de la requête, on l'affiche
    					if($_POST[$hero_name]=="on"){
    						$pretty_name = ucwords($hero_name);
    						echo "<tr><th colspan=\"2\">$pretty_name</th></tr>";
    						foreach($stats as $data => $value){
    							$pretty_string = ucwords(str_replace("_"," ",$data));
		      					echo"<tr><td>$pretty_string</td><td>$value</td></tr>";
    						}
    					}
    				}
    			}
    		}else{  //Quickplay
    			echo '<tr><th colspan="2">Quickplay Stats</th></tr>';
    			foreach($quickplay_stats as $hero_name => $stats){
    				if(array_key_exists($hero_name,$_POST)){
    					if($_POST[$hero_name]=="on"){
    						$pretty_name = ucwords($hero_name);
    						echo "<tr><th colspan=\"2\">$pretty_name</th></tr>";
    						foreach($stats as $data => $value){
    							$pretty_string = ucwords(str_replace("_"," ",$data));
		      					echo"<tr><td>$pretty_string</td><td>$value</td></tr>";
    						}
    					}
    				}
    			}
    		}
    		echo '</table></section>';
	//Affichage du statut des succès	
    	}else if($_POST["query"]=="achievements"){
    		$achievements = $result["achievements"];
    		echo '<section class="achievements"><table>';
    		foreach($achievements as $type => $val){
    			$pretty_title = ucwords($type);
    			echo "<tr><th colspan=\"2\">$pretty_title</th></tr>";
    			foreach($val as $title => $bool){
    				$pretty_string = ucwords(str_replace("_"," ",$title));
    				if($bool==1 || $bool ==true){
    					$obtained = "Achievement Unlocked!";
    				}else{
    					$obtained = "Not Unlocked Yet";
    				}
    				echo"<tr><td>$pretty_string</td><td>$obtained</td></tr>";
    			}
    		}
    		echo'</table></section>';
	}
    	?>

    </section>
  </main>
  <script src="static/main.js"></script>
</body>
</html>
