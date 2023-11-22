<?php
/**
 * displaysessiondetails.php
 *
 * retrieve the session details from either the session file or the database
 *
 * produces a result according to the user entered values and calculation type
 *
 * Author: CF Ingrams
 * Email: <clinton@cfing.co.uk>
 * Date: 22/10/2015
 *
 * @author CF Ingrams <clinton@cfing.co.uk>
 */

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->post(
    '/displaysessiondetails',
    function(Request $request, Response $response)
    use ($app)
    {
        $container = $app->getContainer();

        $settings = $container->get('settings');
        return $response;

    }
);