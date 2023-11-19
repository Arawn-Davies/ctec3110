<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 24/10/17
 * Time: 10:01
 */

declare (strict_types=1);

namespace Country;

class CountryDetailsModel
{
    private $country_code;
    private $detail;
    private $result;


    public function __construct()
    {
        $this->country_code = '';
        $this->detail = '';
        $this->result = [];
    }

    public function __destruct(){}

    public function setParameters($cleaned_parameters)
    {
        $this->country_code = $cleaned_parameters['country'];
        $this->detail = $cleaned_parameters['detail'];
    }

    public function getCountryDetails(object $soap_wrapper, array $settings, array $cleaned_parameters, array $webservice_parameters)
    {
        $soapresult = null;

        $soap_client_handle = $soap_wrapper->createSoapClient($settings);

        if ($soap_client_handle !== false)
        {
            var_dump($webservice_parameters);
            $webservice_function = $webservice_parameters['required_service'];
            $webservice_call_parameters = $webservice_parameters['service_parameters'];
            $webservice_object_name = $webservice_parameters['result_object'];

            $soapcall_result = $soap_wrapper->performSoapCall(
                $soap_client_handle,
                $webservice_function,
                $webservice_call_parameters,
                $webservice_object_name
            );

            return $soapcall_result;
        }
    }

    public function selectCountryDetails($required_country_details): array
    {
        var_dump($required_country_details);

        $selected_details = [];
        $country_code = $required_country_details['country'];
        $required_country_detail = $required_country_details['detail'];

        switch($required_country_detail)
        {
            case 'capital':
                $selected_details['required_service'] = 'CapitalCity';
                $selected_details['service_parameters'] = [
                    'sCountryISOCode' => $country_code
                ];
                $selected_details['result_object'] = 'CapitalCityResult';
                break;
            case 'full':
                $selected_details['required_service'] = 'FullCountryInfo';
                $selected_details['service_parameters'] = [
                    'sCountryISOCode' => $country_code
                ];
                $selected_details['result_object'] = 'FullCountryInfoResult';
                break;
            case 'continents':
                $selected_details['required_service'] = 'ListOfContinentsByName';
                $selected_details['service_parameters'] = [];
                $selected_details['result_object'] = 'ListOfContinentsByNameResult';
                break;
            case 'currency':
                $selected_details['required_service'] = 'CountryCurrency';
                $selected_details['service_parameters'] = [
                    'sCountryISOCode' => $country_code
                ];
                $selected_details['result_object'] = 'CountryCurrencyResult';
                break;
            default:
        }
        var_dump($selected_details);
        return $selected_details;
    }

    public function cleanupUserOptions($validator, $tainted_parameters, $settings): array
    {
        $cleaned_parameters = [];
        $validated_country_code = false;
        $validated_detail_option = false;

        if (isset($tainted_parameters['country']))
        {
            $tainted_country = $tainted_parameters['country'];
            var_dump($tainted_country);
            $validated_country_code = $validator->validateCountryCode($tainted_country);
            var_dump($validated_country_code);
        }

        if (isset($tainted_parameters['detail']))
        {
            $tainted_detail = $tainted_parameters['detail'];
            var_dump($tainted_detail);
            $validated_detail_option = $validator->validateDetailType($tainted_detail, $settings);
            var_dump($validated_detail_option);
        }

        if (($validated_country_code != false) && ($validated_detail_option != false))
        {
            $cleaned_parameters['country'] = $validated_country_code;
            $cleaned_parameters['detail'] = $validated_detail_option;
        }

        return $cleaned_parameters;
    }

    public function validateCountryDetails($validator, $tainted_data)
    {
        $cleaned_data = '';

        if (is_string($tainted_data) == true)
        {
            $cleaned_data = $validator->validateDownloadedData($tainted_data);
        }
        else
        {
            $cleaned_data = $tainted_data;
        }

        return $cleaned_data;
    }
}