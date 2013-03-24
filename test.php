<?php
error_reporting(E_ALL);

require_once 'RealClassTrait.php';
require_once 'Person.php';
require_once 'Employee.php';

$person = new Employee("Sean", 33);

$person->name = 'Sean2';
$person->favoriteColor = 'blue';
$person->sayName();

