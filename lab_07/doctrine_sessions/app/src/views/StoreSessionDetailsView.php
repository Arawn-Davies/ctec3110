<?php

namespace DoctrineSessions\views;

class StoreSessionDetailsView
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function createStoreDetailsResultView(object $view, array $settings, object $response, array $cleaned_parameters, bool $storage_result): void
    {
        $sid = session_id();

        $landing_page = $settings['landing_page'];
        $css_path = $settings['css_path'];

        $username = $cleaned_parameters['username'];
        $password = $cleaned_parameters['password'];
        $server_type = $cleaned_parameters['server_type'];

        if ($storage_result)
        {
            $storage_result_message = 'The data was stored successfully';
        }
        else
        {
            echo 'Ooops, ' . $storage_result;
            $storage_result_message = 'Ooops, ' . $storage_result;
        }

        $view->render($response,
            'display_storage_result.html.twig',
            [
                'landing_page' => $landing_page,
                'css_path' => $css_path,
                'action' => 'displaysessiondetails',
                'page_title' => 'Sessions Demonstration',
                'page_heading_1' => 'Sessions Demonstration',
                'page_heading_2' => 'Session storage result',
                'sid_text' => 'Your super secret session SID is ',
                'sid' => $sid,
                'username' => $username,
                'password' => $password,
                'server_type' => $server_type,
                'storage_result_message' => $storage_result_message
            ]);

    }
}