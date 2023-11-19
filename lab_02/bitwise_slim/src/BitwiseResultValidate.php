<?php

/**
 * BitwiseResultValidate.php
 *
 * Bitwise: PHP web application to demonstrate "bit chopping"
 * Each bit within a byte can be analysed to detect its state,
 * either true of false.  This technique can be used to pack lost of
 * information into  a single byte
 *
 * Validate class to validate & sanitise the user entered value
 * returns an error flag if there was a problem
 *
 * Uses a filter_var with array of limiting values
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 *
 * @package bitwise
 */

class BitwiseResultValidate
{
    private $tainted;
    private $cleaned;

    public function __construct()
    {
        $this->tainted = [];
        $this->cleaned = [];
    }

    public function __destruct()
    {
    }

    public function getSanitisedInput()
    {
        return $this->cleaned;
    }

    public function sanitiseInput()
    {
        $this->tainted = $_POST;
        $this->cleaned['sanitised_value'] = false;
        $tainted_value = $this->tainted['integer_to_analyse'];
        $sanitised_value = filter_var($tainted_value, FILTER_SANITIZE_NUMBER_INT);
        $filter_int_options = [
            'options' =>
                [
                    'default' => -1,
                    'min_range' => 0,
                    'max_range' => 255
                ]];
        $sanitised_and_filtered_value = filter_var($sanitised_value, FILTER_VALIDATE_INT, $filter_int_options);
        if ($sanitised_and_filtered_value && $sanitised_and_filtered_value >= 0) {
            $this->cleaned['sanitised_value'] = $sanitised_and_filtered_value;
        }
    }
}
