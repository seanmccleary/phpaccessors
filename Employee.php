<?php
class Employee extends Person
{
	public function __set($name, $value) {
		echo "Setting\n";
		parent::__set($name, $value);
	}

}
