<?php

class Person
{
	private $name;
	private $age;
	public $animal;

	public function __construct($name, $age, $animal)
	{
		$this->name = $name;
		$this->age = $age;
		$this->animal = $animal;
	}

	public function feed(callable $closure){
		$closure($this->animal);
	}
}

class Animal
{
	private $name;
	private $type;
	private $breed;

	public function __construct($name, $type, $breed)
	{
		$this->name = $name;
		$this->type = $type;
		$this->breed = $breed;
	}

	public function getSpecs()
	{
		return $this->name . ", " . $this->type . ", " . $this->breed;
	}

	public function eats($food)
	{
		echo $this->name . " is eating the " . $food;
	}
}

$roxy = new Animal("Roxy", "Dog", "Labrador");
$danny = new Person("Danny", 20, new Animal("ExampleName", "Cat", "Brits korthaar"));

$danny->feed(function($animal) {
	$animal->eats("Spaghetti");
	echo "</br>";
	$animal->eats("Rice");
});

// Pass Lambda to function
// function shout ($message){
//   echo $message();
// }
 
// Call function
// shout(function(){
//   return "Hello world";
// });
// 
echo "<br>";
echo "<br>";
class Route
{
	public static function get(string $first, callable $closure)
	{
		$closure("Danny");
	}
}

$achternaam = "Jager";
Route::get('user/(:any)', function($voornaam) use ($achternaam){
  echo "Hallo " . $voornaam . " " . $achternaam;
});