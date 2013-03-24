<?php
/**
 * A class for blah
 * @property favoriteColor
 */
class Person
{
	use AccessorsTrait;

	public $name;

	private $_favoriteColor;

	private $_age;

	public function setFavoriteColor($value) {
		$this->_favoriteColor = $value;
	}

	public function getFavoriteColor() {
		return $this->_favoriteColor;
	}

	public function setAge($value) {
		$this->_age = $value;
	}

	public function getAge() {
		return $this->_age;
	}

	public function sayName() {
		echo "Hi I am {$this->name} and I like {$this->favoriteColor}\n";
	}
}
