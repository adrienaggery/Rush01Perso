<?php

require 'vendor/autoload.php';
require 'classes/Game.class.php';

$games = array();

function parseURI($request){
	$requestarray = (array)$request;
	$requestarraykeys = array_keys($requestarray);
	$uristring = $requestarray[$requestarraykeys[2]];

	$uri = trim($uristring, "/ \t\n\r\0\x0B");

	return explode('/', $uri);
}

$app = function ($request, $response) {

	$uri = parseURI($request);

	if (!empty($uri[0]))
		call_user_func($uri[0]);

};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);

$http->on('request', $app);
echo "Server running at http://127.0.0.1:1337\n";

$socket->listen(1337);
$loop->run();

// Accessors

function getGamesCount() { return count($games); }

// API calls

function creategame(){
	$games[] = new Game();
}

