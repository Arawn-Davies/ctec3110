<?php
/**
 * HomePageController.php
 *
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 * @package dates services
 */

namespace DoctrineSessions\Controllers;

class HomePageController
{

    public function createHtmlOutput($container, $request, $response)
    {
        $view = $container->get('view');
        $settings = $container->get('settings');
        $homepage_view = $container->get('homePageView');

        $homepage_view->createHomePageView($view, $settings, $response);
    }
}