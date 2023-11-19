<?php

declare (strict_types=1);

namespace Country;

class HomePageView
{
    public function __construct(){}

    public function __destruct(){}

    public function createHomePageView($view, $settings, $response, $country_names)
    {

        $application_name = $settings['application_name'];
        $landing_page = $settings['landing_page'];
        $css_path = $settings['css_path'];

        $view->render(
            $response,
            'homepageform.html.twig',
            [
                'css_path' => $css_path,
                'landing_page' => $landing_page,
                'method' => 'post',
                'action' => 'processcountrydetails',
                'initial_input_box_value' => null,
                'page_title' => $application_name,
                'page_heading_1' => $application_name,
                'page_heading_2' => 'Display details about a country',
                'country_names' => $country_names,
                'page_text' => 'Select a country name, then select the required information details',
            ]
        );
    }
}
