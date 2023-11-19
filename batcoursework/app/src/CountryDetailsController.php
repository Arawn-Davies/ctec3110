<?php

declare (strict_types=1);

namespace Country;

class CountryDetailsController
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function createResults($app, $response, $tainted_parameters)
    {
        $country_details_model = $app->getContainer()->get('countryDetailsModel');
        $country_details_view = $app->getContainer()->get('countryDetailsView');
        $soap_wrapper = $app->getContainer()->get('soapWrapper');
        $validator = $app->getContainer()->get('validator');

        $view = $app->getContainer()->get('view');
        $settings = $app->getContainer()->get('settings');

        var_dump($tainted_parameters);
        $cleaned_required_country_details = $country_details_model->cleanupUserOptions($validator, $tainted_parameters, $settings);
        var_dump($cleaned_required_country_details);
        $webservice_parameters = $country_details_model->selectCountryDetails($cleaned_required_country_details);
        var_dump($webservice_parameters);

        $country_details_result = $country_details_model->getCountryDetails(
            $soap_wrapper,
            $settings,
            $cleaned_required_country_details,
            $webservice_parameters
        );

        $validated_country_details = $country_details_model->validateCountryDetails(
            $validator,
            $country_details_result['webservice_returned_data']
        );

        $country_details_result['webservice_returned_data'] = $validated_country_details;

        var_dump($country_details_result);

        $country_details_view->createResultsView($view, $settings, $response, $country_details_result);
    }
}
