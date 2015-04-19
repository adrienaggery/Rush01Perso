<?php

function route_creategame($response, &$games, $uri){

	$game = new Game(count($games), $uri[1]);

	$games[] = $game;

	$json = json_encode(array('id' => $game->getID()));

	echo "Game " . $game->getName() . " created with ID: " . $game->getID() . "\n";

	// Response generation
	
	$headers = array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*');
	$response->writeHead(200, $headers);
	$response->end($json);
}

function route_getopenedgames($response, &$games, $uri){

	$openenedgames = array();

	foreach($games as $game){
		if ($game->isOpened())
			$openedgames[] = $game->getID();
	}

	$json = json_encode($openedgames);

	$headers = array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*');
	$response->writeHead(200, $headers);
	$response->end($json);
}

function route_getgameinfo($response, &$games, $uri){

	foreach($games as $game)
		if ($game->getID() == $uri[1]){
			$json = json_encode(array(
				'id' => $game->getID(),
				'name' => $game->getName(),
				'playercount' => $game->getPlayerCount(),
				'players' => $game->getPlayers()));
			break;
		}

	if(empty($json))
		$json = json_encode(array('id' => -1));

	$headers = array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*');
	$response->writeHead(200, $headers);
	$response->end($json);
}

function route_getlobbyinfo($response, &$games, $uri){
	foreach($games as $game)
		if ($game->getID() == $uri[1]){
			$json = json_encode(array(
				'gameid' => $game->getID(),
				'gamename' => $game->getName(),
				'playercount' => $game->getPlayerCount(),
				'players' => $game->getPlayerPseudos()));
			break;
		}

	if (empty($json))
		$json = json_encode(array('gameid' => -1));

	$headers = array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*');
	$response->writeHead(200, $headers);
	$response->end($json);
}

function route_joingame($response, &$games, $uri){

	foreach($games as $game){
		if ($game->getID() == $uri[1] && $game->isOpened()){
			$error = $game->addPlayer($uri[2]);
			$json = json_encode(array('status' => $error));
			break;
		}
	}

	if($error != -1 && !empty($json))
		echo $uri[2] . " joined game: " . $game->getName() . " with ID: " . $game->getID() . "\n";

	$headers = array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*');
	$response->writeHead(200, $headers);
	$response->end($json);
}

function route_startgame($response, &$games, $uri){

	foreach($games as $game){
		if ($game->getID() == $uri[1]){
			$error = $game->startGame(urldecode($uri[2]));
			break;
		}
	}

	$json = json_encode(array('status' => $error));

	$headers = array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*');
	$response->writeHead(200, $headers);
	$response->end($json);
}

function route_turn($response, &$games, $uri){

	foreach($games as $game)
		if($game->getID() == $uri[1]){
			$error = $game->isPlayerTurn($uri[2]);
			break;
		}

	$json = json_encode(array('status' => $error));

	$headers = array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*');
	$response->writeHead(200, $headers);
	$response->end($json);
}

function route_getshipspos($response, &$games, $uri){

	foreach($games as $game)
		if($game->getID() == $uri[1]){
			$json = $game->getShipsPos();
			break;
		}

	$headers = array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*');
	$response->writeHead(200, $headers);
	$response->end($json);

}

function route_faviconico(){

}
