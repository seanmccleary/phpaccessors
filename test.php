<?php
/**
 * A quick demo of how this trait will work
 */

require_once 'AccessorsTrait.php';
require_once 'Person.php';

$person = new Person;

/*
 * The "name" property of the Person class is a real property. 
 * We can set it like normal.
 */
$person->name = 'Sean';

/*
 * The "favoriteColor" property is not real, but we have defined 
 * "get" and "set" accessor methods for it so we can treat it like
 * it is.
 */
$person->favoriteColor = 'blue';

/*
 * See?
 */
$person->sayName();

/*
 * There are also getter and setter methods for "age", but we have
 * not defined an @property PHPDoc tag in the class for it,
 * so we can't use it!
 */
try {
    $person->age = 33;
} 
catch(Exception $e) {
    echo "Couldn't set age: " . $e->getMessage() . "\n";
}

/*
 * Lastly, if you try and set a property on an object that was not defined
 * in its class, it won't work.
 */
try {
    $person->isDogOwner = true;
}
catch(Exception $e) {
    echo "Couldn't set dog ownership: " . $e->getMessage() . "\n";
}
