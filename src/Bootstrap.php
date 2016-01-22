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

foreach ($response->getHeaders() as $header) {
    header($header, false);
}

$response->setContent("ff");
echo $response->getContent();
