<?php
/**
 * A class for blah
 * @property xfavoriteColor
 */
class Person
{
	use AccessorsTrait;

	public $name;

	public $age;

	private $_favoriteColor;

	public function __construct($name, $age) {

		$this->name = $name;
		$this->age = $age;
		$this->favoriteColor = 'green';
	}

	protected function setFavoriteColor($value) {
		$this->_favoriteColor = $value;
	}

	public function getFavoriteColor() {
		return $this->_favoriteColor;
	}

	public function sayName() {
		echo "Hi I am {$this->name} and I like {$this->favoriteColor}\n";
	}
}
