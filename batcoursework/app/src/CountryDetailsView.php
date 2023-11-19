<?php

declare (strict_types=1);

namespace Country;

class CountryDetailsView
{
    public function __construct(){}

    public function __destruct(){}

    public function createResultsView($view, $settings, $response, $results): void
    {
        $webservice_function = $results['webservice_function'];
        $webservice_returned_data = $results['webservice_returned_data'];

        switch ($webservice_function) {
            case 'FullCountryInfo':
                $this->displayAllDetails($view, $settings, $response, $webservice_returned_data);
                break;
            case 'ListOfContinentsByName':
                $this->listOfContinentsByName($view, $settings, $response, $webservice_returned_data);
                break;
            case 'CountryCurrency':
                $this->CountryCurrency($view, $settings, $response, $webservice_returned_data);
                break;
            default:
        }
    }

    private function displayAllDetails($view, $settings, $response, $webservice_returned_data): void
    {
        $application_name = $settings['application_name'];
        $landing_page = $settings['landing_page'];
        $css_path = $settings['css_path'];

        $country_name = $webservice_returned_data->sName;
        $capital_city = $webservice_returned_data->sCapitalCity;
        $flag_url = $webservice_returned_data->sCountryFlag;
        $main_languages = $this->createLanguageList($webservice_returned_data);

        $view->render(
            $response,
            'display_country_details.html.twig',
            [
                'css_path' => $css_path,
                'landing_page' => $landing_page,
                'page_title' => $application_name,
                'page_heading_1' => $application_name,
                'page_heading_2' => 'Result',
                'country_name' => $country_name,
                'capital_city' => $capital_city,
                'language' => $main_languages,
                'flag' => $flag_url,
            ]
        );
    }

    private function CountryCurrency($view, $settings, $response, $webservice_returned_data): void
    {
        $currency_name = $webservice_returned_data->sName;
        $application_name = $settings['application_name'];
        $landing_page = $settings['landing_page'];
        $css_path = $settings['css_path'];

        $view->render(
            $response,
            'display_currencyname.html.twig',
            [
                'css_path' => $css_path,
                'landing_page' => $landing_page,
                'page_title' => $application_name,
                'page_heading_1' => $application_name,
                'page_heading_2' => 'Result',
                'currencyname' => $currency_name,
            ]
        );
    }

    private function listOfContinentsByName($view, $settings, $response, $webservice_returned_data): void
    {
        $continents = $webservice_returned_data->tContinent;

        $continent_names = [];
        foreach ($continents as $continent)
        {
            $continent_code = $continent->sCode;
            $continent_names[$continent_code] = $continent->sName;
//            $country_details[$country_detail->sISOCode] = $country_detail->sName;
        }

        $application_name = $settings['application_name'];
        $landing_page = $settings['landing_page'];
        $css_path = $settings['css_path'];

        $view->render(
            $response,
            'display_continent_list.html.twig',
            [
                'css_path' => $css_path,
                'landing_page' => $landing_page,
                'page_title' => $application_name,
                'page_heading_1' => $application_name,
                'page_heading_2' => 'Result',
                'continent_names' => $continent_names,
            ]
        );
    }

    private function createLanguageList($webservice_returned_data): string
    {
        $languages = $webservice_returned_data->Languages;

        $main_languages = 'no data returned';

        if (!empty((array)$languages))
        {
            if (is_array($languages->tLanguage))
            {
                $main_languages = '';
                foreach ($languages->tLanguage as $index=>$language)
                {
                    $main_languages .= $languages->tLanguage[$index]->sName . ', ';
                }
            }
            else
            {
                $main_languages = $languages->tLanguage->sName;
            }
        }
        return $main_languages;
    }
}