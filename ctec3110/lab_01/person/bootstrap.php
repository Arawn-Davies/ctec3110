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

include 'Person.php';
include 'PersonView.php';

$People = [];

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

$app->setBasePath("/ctec3110/lab_01/person");


// functions need to return a Response type
/**
*  path option 1 - no parameters
*  @param $response
*  @return Response
*/
$app->get('/', function (Request $request, Response $response): Response {
    $response->getBody()->write(Generic());
    return $response;
});

/**
 * path option 2 - one parameter
 * @param $name
 * @return Response
 */
$app->get('/{name}', function (Request $request, Response $response, $name): Response {
    $response->getBody()->write(newPerson($name, $DoB = '27 April 2000'));
    return $response;
});
/**
 * path option 3 - two parameters
 * @param $name
 * @param $DoB
 * @return Person
 */
$app->get('/{name}/{DoB}', function (Request $request, Response $response, $name, $DoB) {
    //$response = newName($response);
    $response->getBody()->write(newPerson($DoB, $name));
    return $response;
})->setArgument('DoB', '27 April 2000');

/*$app->get('/{name}/{DoB}', function (Request $request, Response $response, $name, $DoB) {
    $response->getBody()->write(newPerson($name, $DoB));
    return $response;
});
*/




// Main execution try/catch
try {
    $app->run();
} catch (Exception $e) {
    // display an error message
    die("This is not allowed");
}

function Generic(): string
{
    $People[1] = CreatePerson('Bill', '11 August 1949')->sayHello();
    $People[2] = CreatePerson('Fred', '11 August 1948')->sayHello();
    
    $view = new PersonView();
    $view->setPageTitle('Person Class Demonstration');
    $view->setPageContent($People);
    
    $output_html = $view->getOutputHtml();
    
    return $output_html;
}

function newPerson(string $name, string $DoB): string
{
    $People[1] = CreatePerson($name, $DoB)->sayHello();
    $view = new PersonView();
    $view->setPageTitle('Person Class Demonstration');
    $view->setPageContent($People);
    
    $output_html = $view->getOutputHtml();
    
    return $output_html;
}

function CreatePerson(string $name, string $DoB)
{
	$person = new Person();
	$person->setName($name);
	$person->setDoB($DoB);
	return $person;
}