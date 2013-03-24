<?php
class DocPropertyNotSetException extends Exception 
{
}

/**
 * A trait to make PHP classes behave stricter and implements properties.
 *
 * Apply this trait to your classes, and it'll no longer be possible to assign
 * values to non-defined class members, unless there is an accessor method 
 * for it.  
 * 
 * Accessor methods must be of the form "getPropertyName" or "get_property_name".
 * i.e., for a non-existant property called "age" you could define
 * an accessor method called getAge or get_age.
 *
 * @author Sean McCleary <sean.mccleary@gmail.com>
 * @copyright Whatevs
 * @version 2013-02-016-1756
 * @todo It currently exposes protected accessor methods publicly. :(
 */
trait AccessorsTrait
{
    /**
     * Look for an appropriate accessor method.
     *
     * @param string $name The name of the property you want to find an accessor for
     * @param bool $isGetter Whether we're looking for a getter. (If not, setter is assumed.)
     * @return ReflectionMethod
     */
    private function _findAccessorMethod($name, $isGetter) {

        $class = new ReflectionClass($this);
        $lowerCaseName = strtolower($name);
        $prefix = $isGetter ? 'get' : 'set';
        
        $methods = $class->getMethods(
            ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED);

        foreach($methods as $method) {
            $methodName = strtolower($method->getName());
            if(
                $methodName == "{$prefix}{$lowerCaseName}"
                || $methodName == "{$prefix}_{$lowerCaseName}"
            ) {
                // OK we found a suitable accessor, but unless
                // there's a property documented for it, we're going
                // to refuse to use it

                for(
                    $commentClass = $class;
                    $commentClass;
                    $commentClass = $commentClass->getParentClass()
                ) {
                    $docComment = $commentClass->getDocComment();

                    if (preg_match("/@property\s$lowerCaseName/i", $docComment)) {
                        $method->setAccessible(true);
                        return $method;
                    }
                }
                throw new DocPropertyNotSetException(
                    "There is an accessor method for {$name}, but no @property declaration in the PHPDoc comment."
                );
            }
        }
        return null;
    }

    /**
     * @see http://www.php.net/manual/en/language.oop5.overloading.php#object.set
     */
    public function __set($name, $value) {

        try {
            $method = $this->_findAccessorMethod($name, false);
            if ($method !== null) {
                $method->invoke($this, $value);
            }
            else {
                trigger_error("No such property: $name", E_USER_ERROR);
            }
        }
        catch(DocPropertyNotSetException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    /**
     * @see http://www.php.net/manual/en/language.oop5.overloading.php#object.get
     */
    public function __get($name) {

        try {
            $method = $this->_findAccessorMethod($name, true);
            if ($method !== null) {
                return $method->invoke($this);
            }
            else {
                trigger_error("No such property: $name", E_USER_ERROR);
            }
        }
        catch(DocPropertyNotSetException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }
}
