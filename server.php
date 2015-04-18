<?php

require_once('vendor/autoload.php');
require_once('classes/Game.class.php');
require_once("routes.php");

$games = array();

function parseURI($request){
	$requestarray = (array)$request;
	$requestarraykeys = array_keys($requestarray);
	$uristring = $requestarray[$requestarraykeys[2]];

	$uri = trim($uristring, "/ \t\n\r\0\x0B");

	return explode('/', $uri);
}

$app = function ($request, $response) {

	global $games;
	$uri = parseURI($request);

	if (function_exists("route_" . $uri[0])){
		echo "route_" . $uri[0] . " found\n";
		call_user_func_array("route_" . $uri[0], array($response, &$games));
	}
	else 
		echo "route_" . $uri[0] . " not found\n";

	print_r($games);
};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);

$http->on('request', $app);
echo "Server running at http://127.0.0.1:1337\n";

$socket->listen(1337);
$loop->run();

// API calls

