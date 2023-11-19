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

declare (strict_types=1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get(
    '/sessions',
    function(Request $request, Response $response)
    use ($app)
    {

        $sid = session_id();
        $view = $app->getContainer()->get('view');
        $settings = $app->getContainer()->get('settings');

        $landing_page = $settings['landingPage'];
        $css_path = $settings['css_path'];

        $view->render(
            $response,
            'sessionhome.html.twig',
            [
                'css_path' => $css_path,
                'landing_page' => $landing_page,
                'action' => 'storesessiondetails',
                'method' => 'post',
                'initial_input_box_value' => null,
                'page_title' => 'Sessions Demonstration',
                'page_heading_1' => 'Sessions Demonstration',
                'page_heading_2' => 'Enter values for storage in a session',
                'page_heading_3' => 'Select the type of session storage to be used',
                'info_text' => 'Your information will be stored in either a session file or in a database',
                'sid_text' => 'Your super secret session SID is ',
                'sid' => $sid,
            ]);
        return $response;

    }
)->setName('homepage');