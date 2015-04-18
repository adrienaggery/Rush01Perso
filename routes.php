<?php

function route_creategame(&$response){
	$game = new Game();
	$games[] = $game;

	$gameid = array_search($game, $games);


	// Response generation
	$headers = array('Content-Type' => 'json/application');
	$json = json_encode(array('status' => $gameid));
	$response->writeHead(200, $headers);
	$response->end($json);
}
