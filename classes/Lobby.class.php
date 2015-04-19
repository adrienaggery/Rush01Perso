<?php

namespace Rush01;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Lobby implements MessageComponentInterface {
	public function onOpen(ConnectionInterface $conn) {
		echo "New connection to Lobby Server";
	}

	public function onMessage(ConnectionInterface $from, $msg) {
	}

	public function onClose(ConnectionInterface $conn) {
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
	}
}
