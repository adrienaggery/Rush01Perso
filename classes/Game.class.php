<?php

class Game {

	private $_players;
	private $_turn = 0;

	public function getPlayers() { return $this->_players; }
	public function addPlayer( $playerName ) { $this->_players[count($this->getPlayers())] = new Player($playerName); }
	public function getPlayerCount() { return count($this->getPlayers()); }

	public function getCurrentTurn() { return $this->_turn % $this->getPlayerCount(); }
	public function isPlayerTurn( $index ) {
		if ($this->getCurrentTurn() === $index )
			return true;
		else
			return false;
	}
	public function nextTurn() { $this->_turn++; }

	public function __construct() {
		echo "New game created"; 
	}
}

?>
