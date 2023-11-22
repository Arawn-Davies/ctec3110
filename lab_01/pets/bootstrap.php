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

$app->setBasePath("/ctec3110/lab_01/pets");

$app->get('[/]', function (Request $request, Response $response, $origName, $newName): Response {
    $response->getBody()->write(newName($response, $origName, $newName));
    return $response;
})->setArgument('origName', 'Elsie')->setArgument('newName', 'Buster');

$app->get('/{name}', function (Request $request, Response $response, $origName, $name) {
    //$response = newName($response);
    $response->getBody()->write(newName($response, $origName, $name));
    return $response;
})->setArgument('origName', 'Elsie');

$app->get('/{origName}/{newName}', function (Request $request, Response $response, $origName, $newName) {
    $response->getBody()->write(newName($response, $newName, $origName));
    return $response;       
});




// Main execution try/catch
try {
    $app->run();
} catch (Exception $e) {
    // display an error message
    die("This is not allowed");
}



// functions need to return a Response type
/*
  path option 1 - no parameters
  @param $response
  @return Response

function root($response): Response
{
    $output = doPets();
    $response->getBody()->write($output);
    return $response;
}
/


/**
 * path option 2 - one parameter
 * @param $response
 * @return Response
 */
function newName($response, string $origName, string $newName): string
{
    $pet_1_name = '';
    $pet_2_name = '';
    $my_pet = new PetName();
    $my_pet->setPetName($origName);
    $pet_name = $my_pet->getPetName();

    $pet_1_name = 'Pet\'s name is ' . $pet_name;

    $my_pet->setPetName($newName);
    $pet_name = $my_pet->getPetName();

    $pet_2_name = 'New pet\'s name is ' . $pet_name;

    $pets_view = new PetNameView();
    $pets_view->createOutput($pet_1_name, $pet_2_name);

    $output_html = $pets_view->getOutputHtml();
    return $output_html;
}

/*
function doPets(string $origName = 'Elsie', string $newName = 'Buster'): string
{
 $pet_1_name = '';
 $pet_2_name = '';
 $my_pet = new PetName();
 $my_pet->setPetName($origName);
 $pet_name = $my_pet->getPetName();
 $pet_1_name = 'Pet\'s name is ' . $pet_name;
 $my_pet->setPetName($newName);
 $pet_name = $my_pet->getPetName();
 $pet_2_name = 'New pet\'s name is ' . $pet_name;
 $pets_view = new PetNameView();
 $pets_view->createOutput($pet_1_name, $pet_2_name);
 $output_html = $pets_view->getOutputHtml();
 return $output_html;
}
*/