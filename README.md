# PHP Accessors Trait #

This is a trait to make PHP classes behave stricter and implements properties.

This requires PHP >= 5.4.

Apply this trait to your classes, and it'll no longer be possible to assign
values to non-defined class members, unless there is an accessor method 
for it.  
 
Accessor methods must be of the form "getPropertyName" or "get_property_name".
i.e., for a non-existant property called "age" you could define
an accessor method called getAge or get_age.

For an example, see the included test.php and Person.php files.
