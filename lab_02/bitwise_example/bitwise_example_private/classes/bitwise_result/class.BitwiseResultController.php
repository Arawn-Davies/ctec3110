<<<<<<< HEAD
<?php
  /**
   * class.BitwiseResultController.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * Controller class for the result
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseResultController
  {
    private $c_html_output;
    private $c_arr_sanitised_input;
    private $c_arr_page_content;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      $this->c_html_output = '';
      $this->c_arr_sanitised_input = array();
      $this->c_arr_page_content = array();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function get_html_output()
    {
      return $this->c_html_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_create_result()
    {
      $this->do_validate_input();
      $this->do_process_input_values();
      $this->do_create_html_output();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_validate_input()
    {
      $this->c_arr_sanitised_input = BitwiseContainer::make_bitwise_result_validate();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_process_input_values()
    {
      $m_arr_page_content = array();

      $m_arr_bitwise_result = BitwiseContainer::make_bitwise_result_model($this->c_arr_sanitised_input);

      $m_arr_page_content['bitwise_result'] = $m_arr_bitwise_result;
      $m_arr_page_content['validation_result'] = $this->c_arr_sanitised_input;

      $this->c_arr_page_content = $m_arr_page_content;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_create_html_output()
    {
      $this->c_html_output = BitwiseContainer::make_bitwise_result_view($this->c_arr_page_content);
    }
  }
?>
=======
<?php
  /**
   * class.BitwiseResultController.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * Controller class for the result
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseResultController
  {
    private $c_html_output;
    private $c_arr_sanitised_input;
    private $c_arr_page_content;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      $this->c_html_output = '';
      $this->c_arr_sanitised_input = array();
      $this->c_arr_page_content = array();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function get_html_output()
    {
      return $this->c_html_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_create_result()
    {
      $this->do_validate_input();
      $this->do_process_input_values();
      $this->do_create_html_output();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_validate_input()
    {
      $this->c_arr_sanitised_input = BitwiseContainer::make_bitwise_result_validate();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_process_input_values()
    {
      $m_arr_page_content = array();

      $m_arr_bitwise_result = BitwiseContainer::make_bitwise_result_model($this->c_arr_sanitised_input);

      $m_arr_page_content['bitwise_result'] = $m_arr_bitwise_result;
      $m_arr_page_content['validation_result'] = $this->c_arr_sanitised_input;

      $this->c_arr_page_content = $m_arr_page_content;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_create_html_output()
    {
      $this->c_html_output = BitwiseContainer::make_bitwise_result_view($this->c_arr_page_content);
    }
  }
?>
>>>>>>> 5166bf7a3b833f0ae6c73436ea615f3c4c629f63
