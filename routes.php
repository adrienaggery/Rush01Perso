<?php

function route_creategame($response, &$games){
	$game = new Game(count($games));

	$games[] = $game;

	$json = json_encode(array('id' => $game->getID()));

	echo "Game Created\n";

	// Response generation
	
	$headers = array('Content-Type' => 'application/json');
	$response->writeHead(200, $headers);
	$response->end($json);
}

function route_getopenedgames($response, &$games){

	$openenedgames = array();

	foreach($games as $game){
		if ($game->isOpened())
			$openedgames[] = $game->getID();
	}

	$json = json_encode($openedgames);

	$headers = array('Content-Type' => 'application/json');
	$response->writeHead(200, $headers);
	$response->end($json);

}
