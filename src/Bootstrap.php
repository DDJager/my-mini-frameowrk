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

$request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER); // Sets the $request object
$response = new \Http\HttpResponse;	// Sets the $response object

$cookieBuilder = new \Http\CookieBuilder;	// Sets the CookieBuilder object
$cookieBuilder->setDefaultSecure(false);	// Disable the secure flag because this is only an example


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



