<?php

namespace DoctrineSessions\views;

class HomePageView
{
    public function __construct(){}

    public function __destruct(){}

    public function createHomePageView($view, array $settings, $response): void
    {
        $sid = session_id();
        $landing_page = $settings['landing_page'];
        $application_name = $settings['application_name'];
        $css_path = $settings['css_path'];

        $view->render(
            $response,
            'homepageform.html.twig',
            [
                'css_path' => $css_path,
                'application_name' => $application_name,
                'landing_page' => $landing_page,
                'action' => 'storesessiondetails',
                'initial_input_box_value' => null,
                'page_title' => 'Sessions with Doctrine Demonstration',
                'page_heading_1' => 'Sessions Demonstration',
                'page_heading_2' => 'Enter values for storage in a session',
                'page_heading_3' => 'Select the type of session storage to be used',
                'info_text' => 'Your information will be stored in either a session file or in a database',
                'sid_text' => 'Your super secret session SID is ',
                'sid' => $sid,
            ]);
    }
}