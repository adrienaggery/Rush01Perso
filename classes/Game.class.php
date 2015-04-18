<?php

class Game {

	private $_id;
	private $_players;
	private $_turn = 0;

	public function getID(){ return $this->_id; }

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

		public function __construct($id) {
			$this->_id = $id;
			//echo "New game created\n"; 
		}
}

?>
