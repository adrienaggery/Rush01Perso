<?php

require_once("Player.class.php");

class Game {

	private $_id;
	private $_name;
	private $_players;
	private $_turn = 0;
	private $_started = 0;

	public function getID(){ return $this->_id; }

	public function getName(){ return $this->_name; }

	public function getPlayers() { return $this->_players; }
	public function addPlayer( $playerName ) { $this->_players[] = new Player($this->getPlayerCount(), $playerName); }
	public function getPlayerCount() { return count($this->getPlayers()); }

	public function getCurrentTurn() { return $this->_turn % $this->getPlayerCount(); }
	public function isPlayerTurn( $index ) {
		if ($this->getCurrentTurn() === $index)
			return true;
		else
			return false;
	}
	public function nextTurn() { $this->_turn++; }

	public function isOpened(){
		if ($this->_started === 0 && $this->getPlayerCount() < 4)
			return true;
		else 
			return false;
	}

	public function __construct($id, $name) {
		$this->_id = $id;
		$this->_name = $name;
	}

	public function startGame(){
		if ($this->getPlayerCount() >= 2 && $this->getPlayerCount() <= 4){
			$this->_started = 1;
			return false;
		}
		else 
			return true;
		// other things
	}
}

?>
