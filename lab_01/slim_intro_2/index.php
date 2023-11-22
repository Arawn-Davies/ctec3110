<?php
/**
* Simple script to demonstrate the basics of Slim 4
* assign aliases for PSR-7 compliance, and make the app factory available
*
* NB this application will fail unless and until parameters are included
* with the URL
*/
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestResponseArgs;
/**
* register the autoloader for PSR-4 compliance
*/
require 'vendor/autoload.php';
/**
* Instantiate App
*
* In order for the factory to work you need to ensure you have installed
* a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a
* supported ServerRequest creator (included with Slim PSR-7)
*/
$app = AppFactory::create();
/** set the home directory for this application
* NB matches the path in the .htaccess file
*/
$app->setBasePath("/ctec3110/lab_01/slim_intro_2");
// Define route path handler
$app->get(
'/hello/{name}',
function (Request $request, Response $response, $args)
{
$name = $args['name'];
$response->getBody()->write("Hello, $name");
return $response;
}
);
// Run the application
try {
$app->run();
} catch (Exception $e) {
// display an error message
die("Remember that this application route is expecting parameters of
/hello/random name!");
}