<?php

declare (strict_types=1);

use Country\CountryDetailsController;
use Country\CountryDetailsModel;
use Country\CountryDetailsView;
use Country\HomePageController;
use Country\HomePageModel;
use Country\HomePageView;
use Country\SoapWrapper;
use Country\Validator;
use Sessions\SessionValidator;
use Sessions\SessionWrapper;
use Sessions\SessionModel;
use Sessions\DatabaseWrapper;
use Sessions\SQLQueries;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use DI\Container;
use Slim\Views\Twig;
use Slim\App;

// Register components in a container

return function (Container $container, App $app)
{
    $settings = $app->getContainer()->get('settings');
    $template_path = $settings['view']['template_path'];
    $cache_path = $settings['view']['cache_path'];
    $log_file_path = $settings['log_file_path'];

    $container->set(
        'view',
        function ()
        use ($template_path, $cache_path)
        {
            {
                return Twig::create($template_path, ['cache' => false]);
            }
        }
    );

    $container->set('homePageController', function () {
        $controller = new HomePageController();
        return $controller;
    });

    $container->set('homePageModel', function () {
        $model = new HomePageModel();
        return $model;
    });

    $container->set('homePageView', function () {
        $view = new HomePageView();
        return $view;
    });

    $container->set('countryDetailsController', function () {
        $model = new CountryDetailsController();
        return $model;
    });

    $container->set('countryDetailsModel', function () {
        $model = new CountryDetailsModel();
        return $model;
    });

    $container->set('countryDetailsView', function () {
        $model = new CountryDetailsView();
        return $model;
    });

    $container->set('validator', function () {
        $validator = new Validator();
        return $validator;
    });

    $container->set('soapWrapper', function () {
        $soap_wrapper = new SoapWrapper();
        return $soap_wrapper;
    });

    $container->set(
        'sessionvalidator',
        function ()
        {
            $validator = new SessionValidator();
            return $validator;
        }
    );

    $container->set('sessionWrapper', function () {
        $session_wrapper = new SessionWrapper();
        return $session_wrapper;
    });

    $container->set('sessionModel', function () {
        $session_model = new SessionModel();
        return $session_model;
    });

    $container->set('databaseWrapper', function () {
        $database_wrapper_handle = new DatabaseWrapper();
        return $database_wrapper_handle;
    });

    $container->set('sqlQueries', function () {
        $sql_queries = new SQLQueries();
        return $sql_queries;
    });

    /**
     * Creates two log handler streams, one for notices (successful database access)
     * one for warnings (database access error)
     *
     * Based upon the example code from lab 3
     *
     * Uses a closure to add information to the output
     *
     * Lots of guidance at http://zetcode.com/php/monolog/ and https://akrabat.com/logging-errors-in-slim-3/
     *
     * @return Logger
     */

    $container->set(
        'sessionLogger',
        function ()
        use ($log_file_path)
        {
            $logger = new Logger('logger');

            $session_log_notices = $log_file_path . 'sessions_notices.log';
            $stream_notices = new StreamHandler($session_log_notices, Logger::NOTICE);
            $logger->pushHandler($stream_notices);

            $session_log_warnings = $log_file_path . 'sessions_warnings.log';
            $stream_warnings = new StreamHandler($session_log_warnings, Logger::WARNING);
            $logger->pushHandler($stream_warnings);

            $logger->pushProcessor(function ($record) {
                $record['context']['sid'] = session_id();
                $record['extra']['name'] = 'Clinton';
                return $record;
            });

            return $logger;
        }
    );
};