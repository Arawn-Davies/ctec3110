<?php

declare (strict_types=1);

namespace Country;

class Validator
{
    public function __construct() { }

    public function __destruct() { }

    public function validateCountryCode($country_code_to_check)
    {
        $checked_country = false;
        if (isset($country_code_to_check))
        {
            if (!empty($country_code_to_check))
            {
                if (strlen($country_code_to_check) == 2)
                {
                    $checked_country = $country_code_to_check;
                }
            }
            else
            {
                $checked_country = 'none selected';
            }
        }
        return $checked_country;
    }

    public function validateDetailType($type_to_check, $settings)
    {
        $checked_detail_type = false;
        $detail_types = $settings['detail_types'];

        if (in_array($type_to_check, $detail_types) === true)
        {
            $checked_detail_type = $type_to_check;
        }

        return $checked_detail_type;
    }

    public function validateDownloadedData($tainted_data)
    {
        $validated_string_data = '';

        $validated_string_data = filter_var($tainted_data, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

        return $validated_string_data;
    }

    public function sanitiseString($string_to_sanitise)
    {
        $sanitised_string = false;

        if (!empty($string_to_sanitise)) {
            $sanitised_string = htmlspecialchars($string_to_sanitise, ENT_SUBSTITUTE);
        }
        return $sanitised_string;
    }

    public function validateInteger($value_to_check)
    {
        $checked_value = false;
        $options = [
            'options' => [
                'default' => -1, // value to return if the filter fails
                'min_range' => 0
            ]
        ];

        if (isset($value_to_check)) {
            $checked_value = filter_var($value_to_check, FILTER_VALIDATE_INT, $options);
        }

        return $checked_value;
    }

    public function validateServerType($type_to_check)
    {
        $checked_server_type = false;
        $calculation_type = array('file', 'database');

        if (in_array($type_to_check, $calculation_type)) {
            $checked_server_type = $type_to_check;
        }

        return $checked_server_type;
    }
}