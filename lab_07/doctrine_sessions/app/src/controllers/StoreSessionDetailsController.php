<?php
/**
 * HomePageController.php
 *
 * Sessions: PHP web application to demonstrate how databases
 * are accessed securely
 *
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 *
 * @package crypto-show
 */

namespace DoctrineSessions\Controllers;

class StoreSessionDetailsController
{

    public function createHtmlOutput($container, $request, $response): void
    {
        $tainted_parameters = $request->getParsedBody();
        $view =$container->get('view');
        $settings = $container->get('settings');

        $validator = $container->get('sessionValidator');
        $doctrine_queries = $container->get('doctrineSqlQueries');
        $store_session_details_model = $container->get('storeSessionDetailsModel');
        $store_session_details_view = $container->get('storeSessionDetailsView');

        $cleaned_parameters = $store_session_details_model->cleanupParameters($validator, $tainted_parameters);

        $storage_result = $store_session_details_model->storeSessionData($container, $settings, $doctrine_queries, $cleaned_parameters);

        $store_session_details_view->createStoreDetailsResultView($view, $settings, $response, $cleaned_parameters, $storage_result);
    }
}
