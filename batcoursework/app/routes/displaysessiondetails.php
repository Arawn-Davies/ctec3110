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

declare (strict_types=1);
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get(
    '/displaysessiondetails/{type}',
    function(Request $request, Response $response)
    use ($app)
    {
        $view = $app->getContainer()->get('view');
        $settings = $app->getContainer()->get('settings');

        $landing_page = $settings['landingPage'];
        $css_path = $settings['css_path'];
        $sid = session_id();
        $storage_type = $request->getAttribute('type');

        $storage_text = 'Oooops - there was problem retrieving the stored values';
        $storage_result_message = '';

        $retrieved_values = retrieveStoredValues($app, $storage_type);

        if ($retrieved_values !== false)
        {
            $storage_text = 'The values retrieved were:';
        }

        $output_html = $view->render($response,
            'display_stored_data.html.twig',
            [
                'landing_page' => $landing_page,
                'css_path' => $css_path,
                'page_title' => 'Sessions Demonstration',
                'page_heading_1' => 'Sessions Demonstration',
                'page_heading_2' => 'Session storage result',
                'sid_text' => 'Your super secret session SID is ',
                'sid' => $sid,
                'username' => $retrieved_values['username'],
                'password' => $retrieved_values['password'],
                'server_type' => $storage_type,
                'storage_text' => $storage_text,
                'storage_result_message' => $storage_result_message,
            ]);
        return $output_html;
    });

function retrieveStoredValues($app, $storage_type)
{
    $retrieved_values = false;
    $db_conf = $app->getContainer()->get('settings');
    $database_connection_settings = $db_conf['pdo_settings'];

    $session_wrapper = $app->getContainer()->get('sessionWrapper');
    $database_wrapper = $app->getContainer()->get('databaseWrapper');
    $session_model = $app->getContainer()->get('sessionModel');
    $sql_queries = $app->getContainer()->get('sqlQueries');
    $session_logger = $app->getContainer()->get('sessionLogger');
    $session_model->setSessionWrapperFile($session_wrapper);

    $session_model->setSessionWrapperDatabase($database_wrapper);
    $session_model->setSqlQueries($sql_queries);
    $session_model->setDatabaseConnectionSettings($database_connection_settings);
    $session_model->setServerType($storage_type);
    $session_model->setLogger($session_logger);

    $retrieved_values = $session_model->retrieveStoredValues();

    return $retrieved_values;
}

