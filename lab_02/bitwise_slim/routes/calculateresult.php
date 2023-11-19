<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'src/BitwiseResultsController.php';

/**
 * NB $app is defined in the bootstrap script
 */
$app->post(
    '/calculateresult',
    function (Request $request, Response $response): Response
    {
        $page_content = [];
        $bitwise_result = false;

        $bitwise_result = new BitwiseResultsController();
        $bitwise_result->bitwiseCreateResults();
        $html_output = $bitwise_result->getHtmlOutput();

        $response->getBody()->write($html_output);

        return $response;
    }
);
