<?php
/**
 * Simple script to demonstrate the basics of Slim 4
 * assign aliases for PSR-7 compliance, and make the app factory available
 */
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
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
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 */
$app = AppFactory::create();
/**
 * Changing the default invocation strategy on the RouteCollector component
 * will change it for every route being defined after this change being applied
 * Gives direct access to URL parameter values
 */
$routeCollector = $app->getRouteCollector();
$routeCollector->setDefaultInvocationStrategy(new RequestResponseArgs());

$app->setBasePath("/ctec3110/lab_01/slim_intro_3");

$app->get('/', function (Request $request, Response $response): Response {
 $response = root($response);
 return $response;
});

$app->get('/sayhi', function (Request $request, Response $response): Response
{
 $response = sayhi($response);
 return $response;
});

$app->get('/sayhi2u/{name}', function (Request $request, Response $response,
$name): Response {
 $response = sayhi2u($name, $response);
 return $response;
});


try {
 $app->run();
} catch (Exception $e) {
 // display an error message
 die("This action is not allowed");
}
// functions need to return a Response type
/**
 * path option 1 - no parameters
 * @param $response
 * @return Response
 */
function root($response): Response
{
 $output = 'path to the root directory';
 $response->getBody()->write($output);
 return $response;
}
/**
 * path option 2 - one parameter
 * @param $response
 * @return Response
 */
function sayhi($response): Response
{
 $output = 'hello world again';
 $response->getBody()->write($output);
 return $response;
}

/**
 * path option 3 - two parameters
 * @param $name
 * @param $response
 * @return Response
 */
function sayhi2u($name, $response): Response
{
 $output = 'Hi ' . $name;
 $response->getBody()->write($output);
 return $response;
}
