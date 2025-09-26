<?php
require_once("src/Animals/Cat.php");
require_once("src/Animals/Dog.php");
require_once("src/People/Person.php");

use Animals\Cat;
use Animals\Dog;
use People\Person as Idiot;

$cat = new Cat();
$dog = new Dog();
$person = new Idiot("Idiot Younger");

echo $cat->meow() . "\n";
echo $dog->bark() . "\n";
echo $person->name;

?>