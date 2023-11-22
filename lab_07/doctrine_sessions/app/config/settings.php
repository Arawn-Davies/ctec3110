<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 13/10/17
 * Time: 12:33
 */

declare (strict_types=1);

use DI\Container;


// callback function to make settings available in an array

return function (Container $container, string $app_dir)
{
    $app_url = dirname($_SERVER['SCRIPT_NAME']);

    $container->set(
        'settings',
        function()
        use ($app_dir, $app_url)
        {
            return [
                'landing_page' => '/ctec3110/lab_07/doctrine_sessions/',
                'application_name' => 'Database access with Doctrine',
                'css_path' => $app_url . '/css/sessions.css',

                // Returns a detailed HTML page with error details and
                // a stack trace. Should be disabled in production.
                'displayErrorDetails' => true,
                // Whether to display errors on the internal PHP log or not.
                'logErrors' => true,
                // If true, display full errors with message and stack trace on the PHP log.
                // If false, display only "Slim Application Error" on the PHP log.
                // Doesn't do anything when 'logErrors' is false.
                'logErrorDetails' => true,
                'log_file_path' => '/p3t/phpappfolder/logs/',
                'addContentLengthHeader' => false,
                'mode' => 'development',
                'debug' => true,
                'view' => [
                    'template_path' => $app_dir . 'templates/',
                    'cache_path' => $app_dir . 'cache/',
                    'twig' => [
                        'cache' => false,
                        'auto_reload' => true
                    ],
                ],
                'doctrine_connection' => [
                    'driver' => 'pdo_mysql',
                    'host' => 'localhost',
                    'port' => '3306',
                    'charset' => 'utf8mb4',
                    'user'     => 'session_user',
                    'dbname'   => 'session_db',
                    'password' => 'session_user_pass',

                ]
            ];
        }
    );
};
