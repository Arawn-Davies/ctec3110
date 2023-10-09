<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require_once 'Person.php';
require_once 'View.php';

require 'vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath("/ctec3110/lab_02/personal_details");

$app->get(
    '/',
    function (Request $request, Response $response): Response
    {

        $output = [];
        $output = doPerson();
        $output_html = doView($output);

        $response->getBody()->write($output_html);

        return $response;
    }
);

try {
    $app->run();
} catch (Exception $e) {
    // display an error message
    die("Did you say the magic word???");
}

function doPerson(): array
{
    $output = [];

    $person = new Person();
    $person->setName('Bill');
    $person->setDateOfBirth(8, 11, 1048);

    $output[1] = $person->sayHello();

    $person->setName('Fred');
    $person->setDateOfBirth(8, 11, 2023);
//    $person->setDateOfBirth(20, 6,2025);
    $output[2] = $person->sayHello();

    return $output;
}

/**
 * Creates a View object, calls methods to create and return the output
 * @param $output
 * @return string
 */
function doView($output): string
{
    $output_html = '';
    $view = new View();
    $view->setPageTitle('Person Class Demonstration');
    $view->setPageContent($output);
    $view->createHtmlContent();
    $output_html = $view->getOutputHtml();

    return $output_html;
}
