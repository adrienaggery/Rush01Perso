<?php

require_once('vendor/autoload.php');
require_once('classes/Game.class.php');

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

	var_dump($uri);
	var_dump("route"->_$uri[0]);
	if (!empty($uri[0]) && function_exists("route_" + $uri[0]))
		call_user_func("route_" + $uri[0], $response);

};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);

$http->on('request', $app);
echo "Server running at http://127.0.0.1:1337\n";

$socket->listen(1337);
$loop->run();

// API calls

require_once("routes.php");

