<?php
/**
* Simple script to demonstrate the basics of Slim 4
* assign aliases for the interfaces used to achieve PSR-7 compliance,
* and make the app factory available
*/
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
/**
* register the autoloader for PSR-4 compliance
*/
require 'vendor/autoload.php';
/**
* Instantiate App
*
* In order for the factory to work you need to ensure you have installed
* a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a
supported ServerRequest creator (included with Slim PSR-7)
*/
$app = AppFactory::create();
/** set the home directory for this application
* NB matches the path in the .htaccess file
*/
$app->setBasePath("/ctec3110/lab_01/slim_intro_1");
/**
* define default path handler
* ie no parameters added to the URL
*/
$app->get(
'/',
function (Request $request, Response $response)
{
$response->getBody()->write('<h2>Hello World</h2>');
$response->getBody()->write('<p>Today\'s date is ' . gmdate("M d Y") .
'</p>');
return $response;
}
);
/**
* Attempt to execute the app
* If there is a problem, supply an error message for the user
* Can add a var_dump($e) for the developer :-)
*/
try {
$app->run();
} catch (Exception $e) {
// display an error message
die("This action is not allowed");
}