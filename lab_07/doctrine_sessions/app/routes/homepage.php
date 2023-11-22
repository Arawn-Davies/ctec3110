<?php
/**
 * homepage.php
 *
 * display the check primes application homepage
 *
 * allows the user to enter a value for testing if prime
 *
 * Author: CF Ingrams
 * Email: <clinton@cfing.co.uk>
 * Date: 18/10/2015
 *
 * @author CF Ingrams <clinton@cfing.co.uk>
 */

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get(
    '/',
    function(Request $request, Response $response)
    use ($app)
    {
        $container = $app->getContainer();

        $home_page_controller = $container->get('homePageController');
        $home_page_controller->createHtmlOutput($container, $request, $response);
        return $response;
    }
);
