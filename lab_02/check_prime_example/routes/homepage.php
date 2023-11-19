<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
$app->get(
 '/',
 function (Request $request, Response $response): Response
 {
    $homepage_html = createForm();
    $response->getBody()->write($homepage_html);
    return $response;
    }
   );
   function createForm()
   {
    $homepage_html = <<< HOMEPAGE
   <!DOCTYPE html>
   <html lang=”en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Test integer for Prime-ness</title>
    </head>
    <body>
    <form method="post" action="checkprimenumber">
    <h2>Is your number prime?</h2>
    <label for="guess">What is your number?</label>
    <input id="guess" name="guess_prime" type="text">
    <br><br>
    <input type="submit" value="Click here to see if it is Prime">
    </form>
    </body>
   </html>
   HOMEPAGE;
    return $homepage_html;
   }