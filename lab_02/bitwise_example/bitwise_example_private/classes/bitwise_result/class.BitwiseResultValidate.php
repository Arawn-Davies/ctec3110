<?php
  /**
   * class.BitwiseResultValidate.php
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
    private $c_arr_tainted;
    private $c_arr_cleaned;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      $this->c_arr_tainted = array();
      $this->c_arr_cleaned = array();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct() {}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function get_sanitised_input()
    {
      return $this->c_arr_cleaned;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_sanitise_input()
    {
      $this->c_arr_tainted = $_POST;
      $this->c_arr_cleaned['validate_error'] = false;
      $m_error_count = 0;

      $m_tainted_value = $this->c_arr_tainted['integer_to_analyse'];
      $m_sanitised_value = filter_var($m_tainted_value, FILTER_SANITIZE_NUMBER_INT);

      $m_filter_int_options = array('options' => array('default' => -1, 'min_range' => 0, 'max_range' => 255));
      $m_sanitised_and_filtered_value = filter_var($m_sanitised_value, FILTER_VALIDATE_INT, $m_filter_int_options);

      if ($m_sanitised_and_filtered_value && $m_sanitised_and_filtered_value >= 0)
      {
        $this->c_arr_cleaned['sanitised_value'] = $m_sanitised_and_filtered_value;
      }
      else
      {
        $m_error_count += 1;
      }

      if ($m_error_count > 0)
      {
        $this->c_arr_cleaned['validate_error'] = true;
      }
    }
  }
?>
