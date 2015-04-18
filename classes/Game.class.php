<?php

require_once("Player.class.php");
//require_once("Faction.class.php");
//require_once("Ship.class.php");

class Game {

	private $_id;
	private $_name;
	private $_players;
	private $_turn = 0;
	private $_started = false;

	public function getID(){ return $this->_id; }

	public function getName(){ return $this->_name; }

	public function getPlayers() { return $this->_players; }
	public function addPlayer( $playerName ) {
		if ($this->isOpened()){
			$this->_players[] = new Player($this->getPlayerCount(), $playerName); 
			return 0;
		}
		else
			return 1;
	}
	public function getPlayerCount() { return count($this->getPlayers()); }
	public function getPlayerID($pseudo){
		foreach($this->getPlayers() as $player){
			if($player->getPseudo() == $pseudo)
				return $player->getID();
			else
				return null;
		}
	}

	public function getCurrentTurn() { return $this->_turn % $this->getPlayerCount(); }
	public function isPlayerTurn( $pseudo ) {
		if ($this->getCurrentTurn() == $this->getPlayerID($pseudo))
			return true;
		else
			return false;
	}
	public function nextTurn() { $this->_turn++; }

		public function isOpened(){
		if ($this->_started == false && $this->getPlayerCount() < 4)
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
			$this->_started = true;
			return false;
		}
		else 
			return true;
	}

	// Map drawing and calls
	
}

?>
