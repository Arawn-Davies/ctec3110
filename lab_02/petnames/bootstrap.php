<?php
/** script to demonstrate multiple routes with multiple path handlers
 * route 1 - no names entered as parameters
 * route 2 - a single name entered
 * route 3 - two names entered
 *
 * In each case, a suitable response message is returned to the user
 */

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require_once 'PetName.php';
require_once 'PetNameView.php';

require 'vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath("/ctec3110/lab_02/petnames");

/**
 * route 1 - no names were added as a parameter
 */
$app->get(
    '/',
    function (Request $request, Response $response): Response
    {

        $output_message = '';
        $output_message = doNoName();
        $response->getBody()->write($output_message);

        return $response;
    }
);

/**
 * route 2 - a single name was added as a parameter,
 * but two are needed
 */
$app->get(
    '/{name1}',
    function (Request $request, Response $response): Response
    {

        $output_message = '';
        $name1 = $request->getAttribute('name1');
        $output_message = doOneName($name1);

        $response->getBody()->write($output_message);

        return $response;
    }
);

/**
 * route 3 - two names were added as parameters
 */

$app->get(
    '/{name1}/{name2}',
    function (Request $request, Response $response, $args): Response
    {
        $name1 = $args['name1'];
        $name2 = $args['name2'];

        $pet_messages = [];
        $pet_messages[1] = doPet($name1);
        $pet_messages[2] = doPet($name2);

        $output_message = doPetOutput($pet_messages);

        $response->getBody()->write($output_message);

        return $response;
    }
);

try {
    $app->run();
} catch (Exception $e) {
    // display an error message
    die("Did you say the magic word???");
}

function doNoName(): string
{
    $output_message = 'error - no pet names were entered!';
    return $output_message;
}

function doOneName(string $name1): string
{
    $output_message = 'error - only one pet name, ' . $name1 . ' was entered!';
    return $output_message;
}

function doPet($name): string
{
    $output_message = '';

    //create a new object
    $my_pet = new PetName();

    //assign a value to the petname attribute in the object
    $my_pet->setPetName($name);

    //retrieve the pet's name from the object's attribute
    $my_pet_name = $my_pet->getPetName();

    $output_message = 'Pet\'s name is ' . $my_pet_name;

    return $output_message;
}

function doPetOutput($pet_messages): string
{

    // create a view object and pass the output strings to the view object
    $pets_view = new PetNameView();
    $pets_view->setOutput($pet_messages);
    $pets_view->createOutput();
    $output_html = $pets_view->getOutputHtml();

    return $output_html;
}
