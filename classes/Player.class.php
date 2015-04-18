<?php

class Player {

	private $_id;
	private $_pseudo;

	public function getID(){ return $this->_id; }
	public function getPseudo(){ return $this->_pseudo; }

	public function __construct($id, $pseudo){
		$this->_id = $id;
		$this->_pseudo = $pseudo;
	}
}

?>
