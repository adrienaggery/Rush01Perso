<?php

namespace Rush01;

require_once("Player.class.php");
require_once("Faction.class.php");
require_once("Ship.class.php");

class Game {

	private static $_globalID = 0;

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
			return $this->getID();
		}
		else
			return -1;
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
	public function getPlayerPseudos(){
		foreach($this->getPlayers() as $player)
			$array[] = $player->getPseudo();

		return $array;
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

	public function __construct($gamename) {
		$this->_id = self::$_globalID;
		self::$_globalID++;
		$this->_name = $gamename;
	}

	public function startGame($jsonfactions){
		var_dump($jsonfactions);
		$this->dispatchFactions($jsonfactions);
		$this->assignShipsByFaction();
		if ($this->getPlayerCount() >= 2 && $this->getPlayerCount() <= 4){
			$this->_started = true;
			return false;
		}
		else 
			return true;
	}

	private function dispatchFactions($jsonfactions){
		$factions = json_decode($jsonfactions, true);
		var_dump($factions);
		foreach($factions as $p => $f){
			$player = $this->getPlayers()[$this->getPlayerID($p)];
			$player->setFaction(new $f());
		}
	}

	private function assignShipsByFaction(){
		foreach($this->getPlayers() as $player){
			$player->setShips( $player->getFaction()->getShipSet() );
		}
	}

	// Map drawing and calls
	public function getShipsPos(){
		if(!$this->_started){
			foreach($this->getPlayers() as $player)
				foreach($player->getShips() as $ship)
					$ships[] = array(
						'ownerPseudo' => $player->getPseudo(),
						'shipType' => $ship->get_class(),
						'shipPosition' => $ship->getPosition());
			return $ships;
		}
		else
			return null;
	}
}

?>
