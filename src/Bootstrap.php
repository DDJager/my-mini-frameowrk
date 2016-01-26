<?php
namespace Src;

require __DIR__ . "/../vendor/autoload.php";

/**
* Report all errors
*/
error_reporting(E_ALL);


/**
* Configuration variable
*/
$environment = "development";


/**
* Register the error handler
*/
$whoops = new \Whoops\Run;
if ($environment !== "production") {
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
	$whoops->pushHandler(function($e){
        echo 'Friendly error page and send an email to the developer';
    });
}
$whoops->register();


/**
* Patricklouys HTTP package
*/

$injector = include("Dependencies.php");

$request = $injector->make("\Http\HttpRequest"); 								// Sets the $request object
$response =  $injector->make("\Http\HttpResponse");								// Sets the $response object

$cookieBuilder = new \Http\CookieBuilder;										// Sets the CookieBuilder object
$cookieBuilder->setDefaultSecure(false);										// Disable the secure flag because this is only an example


/**
* Call the build function from the $cookiebuilder object with a key/value parameter the $cookieBuilder then returns
* an HttpCookie $object which implements the Cookie interface we can then use all objects which
* implements the Cookie interface as an object in the $response->addCookie() method
*/
// $cookie = $cookieBuilder->build('Key', 'Value');
// $response->addCookie($cookie);

foreach ($response->getHeaders() as $header) {
    header($header);
}

/**
* Set the routing
*/
$routeDefinitionCallback = function(\FastRoute\RouteCollector $r) {
    $routesFile = include("Routes.php");
    foreach ($routesFile as $route) {
    	$r->addRoute($route[0], $route[1], $route[2]);
    }
};
$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

switch ($routeInfo[0]) {
	/**
	 * If $routeInfo[0] is equal to the constant of \FastRoute\Dispatcher::NOT_FOUND = 0
	 */
	case \FastRoute\Dispatcher::NOT_FOUND:
		$response->setContent('404 - Page not found');
        $response->setStatusCode(404);
		break;

	/**
	 * If $routeInfo[0] is equal to the constant of \FastRoute\Dispatcher::FOUND = 1
	 */
	case \FastRoute\Dispatcher::FOUND:
		$className = $routeInfo[1][0];
		$method = $routeInfo[1][1];
        $vars = $routeInfo[2];

        $object = $injector->make($className);
        $object->$method($vars);
		break;
	/**
	 * If $routeInfo[0] is equal to the constant of \FastRoute\Dispatcher::METHOD_NOT_ALLOWED = 2
	 */
	case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		$response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
		break;
}

echo $response->getContent();

