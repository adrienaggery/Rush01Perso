<?php

require 'vendor/autoload.php';

function parseURI($request){
	$requestarray = (array)$request;
	$requestarraykeys = array_keys($requestarray);
	$uristring = $requestarray[$requestarraykeys[2]];

	$uri = trim($uristring, "/ \t\n\r\0\x0B");

	return explode('/', $uri);
}

$app = function ($request, $response) {

	$uri = parseURI($request);
	print_r($uri);

    $response->writeHead(200, array('Content-Type' => 'text/plain'));
    $response->end("Hello World\n");
};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);

$http->on('request', $app);
echo "Server running at http://127.0.0.1:1337\n";

$socket->listen(1337);
$loop->run();
