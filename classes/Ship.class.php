<?php

	abstract Class Ship {

		protected $_name;
		protected $_size;
		protected $_sprite;
		protected $_life;
		protected $_power;
		protected $_speed;
		protected $_agility;
		protected $_shield;
		protected $_position;
		private $_weapon;

		public function getName() { return ($this->_name); }
		public function getSize() { return ($this->_size); }
		public function getSprite() { return ($this->_sprite); }
		public function getLife() { return ($this->_life); }
		public function getPower() { return ($this->_power); }
		public function getSpeed() { return ($this->_speed); }
		public function getAgility() { return ($this->_agility); }
		public function getShield() { return ($this->_shield); }
		public function getPosition() { return ($this->_position); }
		public function getWeapon() { return ($this->_weapon); }

		public function setName( $name ) { $this->_name = $name; }
		public function setSize( $size ) { $this->_size = $size; }
		public function setSprite( $sprite ) { $this->_sprite = $sprite; }
		public function setLife( $life ) { $this->_life = $life; }
		public function setPower( $power ) { $this->_power = $power; }
		public function setSpeed( $speed ) { $this->_speed = $speed; }
		public function setAgility( $agility ) { $this->_agility = $agility; }
		public function setShield( $shield ) { $this->_shield = $shield; }
		public function setPosition( array $position ) { $this->_position = $position; }
		public function setWeapon( $weapon ) { $this->_weapon = $weapon; }

		final function possibleMovement( $array_movement ) {

			$speed = $this->getSpeed();
			$x = $this->getPosition()[0];
			$y = $this->getPosition()[1] - $speed;
			$tmp = 0;

			while ( $x <= ($this->getPosition()[0] + $speed) )
			{
				$y = $this->getPosition()[1] - $speed + $tmp;
				while ($y <= $this->getPosition()[1]) {
					$array_movement[] = array($x, $y);
					$y++;
				}
				$x++;
				$tmp++;
			}
			$x--;
			$y--;
			$tmp--;
			while ( $x >= $this->getPosition()[0] )
			{
				$y = $this->getPosition()[1];
				while ($y <= ($this->getPosition()[1] + $speed) - $tmp) {
					$array_movement[] = array($x, $y);
					$y++;
				}
				$x--;
				$tmp--;
			}
			$x++;
			$y--;
			$tmp++;
			while ( $x >= ($this->getPosition()[0] - $speed) )
			{
				$y = $this->getPosition()[1] + $speed - $tmp;
				while ($y >= $this->getPosition()[1]) {
					$array_movement[] = array($x, $y);
					$y--;
				}
				$x--;
				$tmp++;
			}
			$x++;
			$y++;
			$tmp--;
			while ( $x <= $this->getPosition()[0] )
			{
				$y = $this->getPosition()[1];
				while ($y >= ($this->getPosition()[1] - $speed + $tmp) ) {
					$array_movement[] = array($x, $y);
					$y--;
				}
				$x++;
				$tmp--;
			}
			return ($array_movement);
		}

		//public function fire( $target ) {  };
		public function getTargetableCells(){
			$area = array();
			$maxScope = getWeapon()->getMaxScope();
			for($y = 0; $y <= $maxScope * 2; $y++)
				for($x = 0; $x <= $maxScope * 2; $x++)
					$area[$y][$x] = 0;
			updateMatrixForScope($area, $maxScope, getWeapon()->getLongScope(), 3);
			updateMatrixForScope($area, $maxScope, getWeapon()->getMiddleScope(), 2);
			updateMatrixForScope($area, $maxScope, getWeapon()->getShortScope(), 1);
			return $area;
		}

		private function updateMatrixForScope( &$matrix, $maxscope, $scope, $tag ){
			for($y = -$maxscope; $y <= $maxscope; $y++)
				for($x = -$maxscope; $x <= $maxscope; $x++)
					if (abs($x) + abs($y) <= $scope)
						$matrix[$y + $maxscope][$x + $maxscope] = $tag;
		}

}

require_once('ships/OrktobrRoug.class.php');
require_once('ships/WrathOFTheRighteous.class.php');

?>
