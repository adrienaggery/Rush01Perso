<?php

function route_creategame($response, &$games){
	$game = new Game(count($games));

	$json = json_encode(array('status' => $game->getID()));

	array_push($games, $game);

	echo "Game Created\n";

	// Response generation
	
	$headers = array('Content-Type' => 'application/json');
	$response->writeHead(200, $headers);
	$response->end($json);
}

function route_getopenedgames($response){
	
}
