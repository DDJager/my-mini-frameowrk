<?php

namespace Src;

$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

$injector->alias('Src\Template\Renderer', 'Src\Template\MustacheRenderer');

$injector->define('Mustache_Engine', [
	':options' => [
		'loader' => new \Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/src/template/views', [
			'extension' => '.html'
		])
	]
]);
return $injector;



/**
 ********** SHARE *********
 *	Coming soon
 */



/**
 ********** ALIAS ********* 
 * Just like define, but instead of injecting raw data through the constructor, we create or 
 * add an instance of a class (object), this is called dependency injecton
 * @example see below
 */

/**
 * interface Engine {}		
 * class V8 implements Engine {}
 * class V6 implements Engine {}
 * class Car {
 *   private $engine;
 *   public function __construct(Engine $engine) {
 *       $this->engine = $engine;
 *   }
 * }
 *
 * First we create a new interface, then we create two new class called V8 and V6. They both adhere to the Engine interface contract
 * Then we create a Car class which expects an object through the constructor that adheres to the Engine interface contract
 * So at this stage, we can insert or instantiate a new V6 or a V8 instance. But there might be some cases where you
 * only want to inject a V8 instance through the constructor at certain places in your application. We can do
 * this using the Injector::alias() method
 *
 * We can do this by calling tha alias method like so:
 * $injector->alias('Engine', 'V8');
 * Here we're saying that whenever we are going to instantiate a class by using the $injector object
 * that we are going to instantiate a new V8 object through the constructor method when it asks for an Engine interface
 *
 * So when we do:
 * $injector->make('Car');
 * We are instantiating a new object of the Car class, but then it asks for an Engine dependency in the constructor
 * Luckily, we have already defined that whenver we instantiate a new Car class, a new V8 object must be instantiated in the constructor
 * when it asks for an Engine instance/object
 */



/**
 ********** DEFINE *********
 * When a class expects raw data (strings, integers, arrays etc) in the constructor
 * instead of dependency injection (objects) we can map the values of the 
 * of the parameter to the class with the Injector::define() method
 * @example see below
 */

/**
* class Person 
* {
*     public function __construct($name, $age)
*     {
*    	 echo $name . ", " . $age;
*     }
* }
* 
* $injector->define('Person', [
*     ':name' => 'Danny',
*     ':age' => '20'
* ]);
*
* So whenever we instantiate a new object of the Person class using the Auryn dependency injector package:
* $injector->make("Person"); 
* 
* We create a new Person class like so:
* New Person("Danny", 20);
*
* We are pretty much hardcoding the values for the constructor method at this point
*/


