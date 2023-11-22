<?php

declare (strict_types=1);

use DI\Container;
use Slim\Views\Twig;
use Slim\App;

use DoctrineSessions\Controllers\HomePageController;
use DoctrineSessions\Controllers\StoreSessionDetailsController;
use DoctrineSessions\Models\SessionModel;
use DoctrineSessions\Models\StoreSessionDetailsModel;
use DoctrineSessions\Views\HomePageView;
use DoctrineSessions\Views\StoreSessionDetailsView;

use DoctrineSessions\Support\SessionValidator;
use DoctrineSessions\Support\SessionWrapper;
use DoctrineSessions\Support\DatabaseWrapper;
use DoctrineSessions\Support\DoctrineSqlQueries;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Register components in a container

return function (Container $container, App $app)
{
    $settings = $app->getContainer()->get('settings');
    $template_path = $settings['view']['template_path'];
    $cache_path = $settings['view']['cache_path'];

    $container->set(
        'view',
        function () use ($template_path, $cache_path)
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

    $container->set('storeSessionDetailsController', function () {
        $controller = new StoreSessionDetailsController();
        return $controller;
    });

    $container->set('storeSessionDetailsModel', function () {
        $model = new StoreSessionDetailsModel();
        return $model;
    });

    $container->set('sessionModel', function () {
        $model = new SessionModel();
        return $model;
    });

    $container->set('homePageView', function () {
        $view = new HomePageView();
        return $view;
    });

    $container->set('storeSessionDetailsView', function () {
        $view =  new StoreSessionDetailsView();
        return $view;
    });

    $container->set('sessionValidator', function () {
        $validator = new SessionValidator();
        return $validator;
    });

    $container->set('sessionWrapper', function () {
        $session_wrapper = new SessionWrapper();
        return $session_wrapper;
    });

    $container->set('databaseWrapper', function () {
        $database_wrapper_handle = new DatabaseWrapper();
        return $database_wrapper_handle;
    });


    $container->set('doctrineSqlQueries', function () {
        $sql_queries = new DoctrineSqlQueries();
        return $sql_queries;
    });

    /**
     * Using Doctrine
     * @param $c
     * @return \Doctrine\ORM\EntityManager
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    $container->set(
        'doctrineEntityManager',
        function ($container)
        {
            $settings = $container->get('settings');
            $config = ORMSetup::createAnnotationMetadataConfiguration(
                $settings['doctrine']['meta']['entity_path'],
                $settings['doctrine']['meta']['auto_generate_proxies'],
                $settings['doctrine']['meta']['proxy_dir'],
                $settings['doctrine']['meta']['cache'],
                false
            );
            return EntityManager::create($settings['doctrine']['connection'], $config);
        }
    );


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
        {
            $logger = new Logger('logger');

            $session_log_notices = LOG_FILE_PATH . 'sessions_notices.log';
            $stream_notices = new StreamHandler($session_log_notices, Logger::NOTICE);
            $logger->pushHandler($stream_notices);

            $session_log_warnings = LOG_FILE_PATH . 'sessions_warnings.log';
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