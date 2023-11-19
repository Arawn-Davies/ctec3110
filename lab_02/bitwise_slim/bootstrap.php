<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require 'src/BitwiseWebPageTemplateView.php';
require 'src/BitwiseConfig.php';

require 'vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath("/ctec3110/lab_02/bitwise_slim");

require 'routes.php';

$config = new BitwiseConfig();
$config->doDefinitions();

try {
    $app->run();
} catch (Exception $e) {
    // display an error message
    die("Did you say the magic word???");
}
