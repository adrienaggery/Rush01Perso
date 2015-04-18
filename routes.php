<?php

function route_creategame($response, &$games, $uri){

	$game = new Game(count($games), $uri[1]);

	$games[] = $game;

	$json = json_encode(array('id' => $game->getID()));

	echo "Game Created\n";

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
			var_dump($game->getPlayers());
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

function route_joingame($response, &$games, $uri){

	foreach($games as $game){
		if ($game->getID() == $uri[1] && $game->isOpened()){
			echo "Joined a game\n";
			$error = $game->addPlayer($uri[2]);
			$json = json_encode(array('status' => $error));
			break;
		}
	}

	$headers = array('Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*');
	$response->writeHead(200, $headers);
	$response->end($json);
}

function route_startgame($response, &$games, $uri){

	foreach($games as $game){
		if ($game->getID() == $uri[1])
			$error = $game->startGame();
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

function route_faviconico(){

}
