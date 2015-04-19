<?php

use Ratchet\Server\IoServer;
use Rush01\Lobby;

require 'vendor/autoload.php';
require_once('classes/Lobby.class.php');

$server = IoServer::factory(new Lobby(), 8090);

echo "Lobby server running on localhost:1337\n";

$server->run();

?>
