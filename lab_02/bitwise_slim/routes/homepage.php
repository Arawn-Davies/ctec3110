<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'src/BitwiseFormController.php';

/**
 * NB $app is defined in the bootstrap script.  It comes into scope at run time
 */
$app->get(
    '/',
    function (Request $request, Response $response): Response
    {

        $form_controller = new BitwiseFormController();

        $form_controller->bitwiseCreateForm();
        $html_output = $form_controller->getHtmlOutput();

        $response->getBody()->write($html_output);

        return $response;
    }
);
