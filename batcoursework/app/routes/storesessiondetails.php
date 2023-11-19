<?php
/**
 * storesessiondetails.php
 *
 * calculate the result
 *
 * produces a result according to the user entered values and calculation type
 *
 * Author: CF Ingrams
 * Email: <clinton@cfing.co.uk>
 * Date: 22/10/2015
 *
 * @author CF Ingrams <clinton@cfing.co.uk>
 */

declare (strict_types=1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post(
    '/storesessiondetails',
    function (Request $request, Response $output_html)
    use ($app)
    {
        $settings = $app->getContainer()->get('settings');

        $view = $app->getContainer()->get('view');
        $validator = $app->getContainer()->get('sessionvalidator');

        $tainted_parameters = $request->getParsedBody();

        $cleaned_parameters = cleanupParameters($validator, $tainted_parameters);
        $storage_type = $cleaned_parameters['cleaned_server_type'];

        $store_result = doStorage($app, $cleaned_parameters);

        $sid = session_id();
        $landing_page = $settings['landingPage'];
        $css_path = $settings['css_path'];

        $storage_text = 'Oops: there was a problem storing the entered values';
        $storage_result_message = '';

        if ($store_result === true) {
            $storage_text = $storage_result_message .= 'The values stored were: ';
        }

        $output_html = $view->render(
            $output_html,
            'display_storage_result.html.twig',
            [
                'landing_page' => $landing_page,
                'action' => 'displaysessiondetails/' . $storage_type,
                'method' =>'get',
                'css_path' => $css_path,
                'page_title' => 'Sessions Demonstration',
                'page_heading_1' => 'Sessions Demonstration',
                'page_heading_2' => 'Session storage result',
                'sid_text' => 'Your super secret session SID is ',
                'sid' => $sid,
                'storage_text' => $storage_text,
                'username' => $cleaned_parameters['cleaned_username'],
                'password' => $cleaned_parameters['cleaned_password'],
                'server_type' => $cleaned_parameters['cleaned_server_type'],
                'storage_result_message' => $storage_result_message,
            ]
        );

        return $output_html;
    }
);

function cleanupParameters($validator, array $tainted_parameters): array
{
    $cleaned_parameters = [];
    $tainted_username = $tainted_parameters['username'];
    $tainted_server_type = $tainted_parameters['server_type'];

    $cleaned_parameters['cleaned_password'] = $tainted_parameters['password'];
    $cleaned_parameters['cleaned_username'] = $validator->sanitiseString($tainted_username);
    $cleaned_parameters['cleaned_server_type'] = $validator->validateServerType($tainted_server_type);
    return $cleaned_parameters;
}

function doStorage($app, $cleaned_parameters)
{
    $session_wrapper = $app->getContainer()->get('sessionWrapper');
    $database_wrapper = $app->getContainer()->get('databaseWrapper');
    $sql_queries = $app->getContainer()->get('sqlQueries');
    $session_model = $app->getContainer()->get('sessionModel');
    $session_logger = $app->getContainer()->get('sessionLogger');
    $db_conf = $app->getContainer()->get('settings');
    $database_connection_settings = $db_conf['pdo_settings'];

    $store_result = '';
    $session_model->setSessionUsername($cleaned_parameters['cleaned_username']);
    $session_model->setSessionPassword($cleaned_parameters['cleaned_password']);
    $session_model->setServerType($cleaned_parameters['cleaned_server_type']);
    $session_model->setSessionWrapperFile($session_wrapper);
    $session_model->setSessionWrapperDatabase($database_wrapper);
    $session_model->setSqlQueries($sql_queries);
    $session_model->setDatabaseConnectionSettings($database_connection_settings);
    $session_model->setLogger($session_logger);
    $session_model->storeData();
    $store_result = $session_model->getStorageResult();
    return $store_result;
}
