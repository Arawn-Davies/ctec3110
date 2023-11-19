<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestResponseArgs;
require 'vendor/autoload.php';
$app = AppFactory::create();
$app->setBasePath("/ctec3110/lab_02/check_prime_example");
require 'routes.php';
try {
 $app->run();
} catch (Exception $e) {
 // display an error message
 die("Did you say the magic word???");
}