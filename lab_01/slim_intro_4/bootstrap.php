<?php
/**
 * Simple script to demonstrate the basics of Slim 4
 * assign aliases for PSR-7 compliance, and make the app factory available
 */
/**
 * the strict_types declaration must be the FIRST declaration and ONLY applies to the current file
 */
declare(strict_types=1);
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
 */
$app = AppFactory::create();
/**
 * Changing the default invocation strategy on the RouteCollector component
 * will change it for every route being defined after this change being applied
 */
$routeCollector = $app->getRouteCollector();
$routeCollector->setDefaultInvocationStrategy(new RequestResponseArgs());
$app->setBasePath("/ctec3110/lab_01/slim_intro_4");
$app->get('/hello[/{name}]', function (Request $request, Response $response,
$name) {
 $response->getBody()->write("Hello to you, $name");
 return $response;
})->setArgument('name', 'from Clinton');
try {
    $app->run();
   } catch (Exception $e) {
    // display an error message
    die("Did you forget to append /hello to the URL?");
   }
   