<?php

namespace Rush01;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Lobby implements MessageComponentInterface {

	protected $_clients;
	private $_games;

	public function __construct(){
		$this->_clients = new \SplObjectStorage;
	}

	public function onOpen(ConnectionInterface $conn) {
		$this->_clients->attach($conn);
		echo " -> [ID:" . $conn->resourceId . "] has joined Lobby server\n";
	}

	public function onMessage(ConnectionInterface $from, $msg) {
		$data = json_decode($msg);
		switch ($data["msg"]){
		case 201:
			$this->createGame($data["msg-data"]["gamename"]);
			break;
		}
	}

	public function onClose(ConnectionInterface $conn) {
		$this->_clients->detach($conn);
		echo " -> [ID:" . $conn->resourceId . "] has left Lobby server\n";
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
	}

	// Custom methods
	private function createGame($gamename){
		$game = new Game($gamename);
		$gaes[] = $game;
		$broadcast = json_encode(array(
			'msg' => 101,
			'msg-data' => array(
				'gameid' => $game->getID(),
				'gamename' => $game->getName(),
				'playercount' => $game->getPlayerCount())));

		foreach($this->_clients as $client)
			$client->send($broadcast);

		echo " -> Game \"" . $game->getName() . "\" has been created\n";
	}
}
