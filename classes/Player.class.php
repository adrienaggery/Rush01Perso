<?php

class Player {

	private $_id;
	private $_pseudo;
	private $_ships;

	public function getID(){ return $this->_id; }
	public function getPseudo(){ return $this->_pseudo; }

	public function setShips($value){ $this->_ships = $value; }
	public function addShip($value){ $this->_ships[] = $value; }
	public function getShips(){ return $this->_ships; }

	public function __construct($id, $pseudo){
		$this->_id = $id;
		$this->_pseudo = $pseudo;
	}
}

?>
