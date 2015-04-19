<?php

namespace Rush01;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use Rush01\Game;

require_once('classes/Game.class.php');

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
		$data = json_decode($msg, true);
		switch ($data["msg"]){
		case 201:
			$this->createGame($data["msgdata"]["gamename"]);
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
		$this->_games[] = $game;
		$broadcast = json_encode(array(
			'msg' => 101,
			'msgdata' => array(
				'gameid' => $game->getID(),
				'gamename' => $game->getName(),
				'playercount' => $game->getPlayerCount())));

		foreach($this->_clients as $client)
			$client->send($broadcast);

		echo " -> Game \"" . $game->getName() . "\" has been created\n";
	}
}
