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

    $container->set('settings', function() use ($app_dir, $app_url)
    {
        return [
            'landing_page' => '/ctec3110/BATcoursework/',
            'landingPage' => '/ctec3110/BATcoursework/sessions',
            'application_name' => 'BAT Coursework',
            'css_path' => $app_url . '/css/standard.css',
            'log_file_path' => '/p3t/phpappfolder/logs/',
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
            'log_file_path' => '/p3t/phpappfolder/logs/',
            'addContentLengthHeader' => false,
            'mode' => 'development',
            'debug' => true,
            'wsdl' => 'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL',
            'view' => [
                'template_path' => $app_dir . 'templates/',
                'cache_path' => $app_dir . 'cache/',
                'twig' => [
                    'cache' => false,
                    'auto_reload' => true
                ],
            ],
            'detail_types' => [
                'capital',
                'continents',
                'full',
                'gmt',
                'currency'
            ],
            'pdo_settings' => [
                'rdbms' => 'mysql',
                'host' => 'localhost',
                'db_name' => 'session_db',
                'port' => '3306',
                'user_name' => 'session_user',
                'user_password' => 'session_user_pass',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'options' => [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => true,

                ],
            ],
        ];
    });
};
