<?php
  /**
   * class.BitwiseResultView.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * View class for the result
   * Output depends upon success or failure message from the Model class.
   *
   * All view classes extend the BitwiseWebPageTemplateView class to give
   * a consistent web page layout
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseResultView extends BitwiseWebPageTemplateView
  {
    private $c_arr_page_content;
    private $c_calculation_result_message;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      parent::__construct();
      $this->c_arr_page_content = array();
      $this->c_calculation_result_message = '';
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct() {}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function set_output_values($p_arr_page_content)
    {
      $this->c_arr_page_content = $p_arr_page_content;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function create_output_page()
    {
      $this->set_page_title();
      $this->get_bitwise_result_message();
      $this->create_web_page();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function get_html_output()
    {
      return $this->c_html_page_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function set_page_title()
    {
      $this->c_page_title = 'Bitwise Processing result...';
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function get_bitwise_result_message()
    {
      // select output page to create
      if ($this->c_arr_page_content['validation_result']['validate_error'])
      {
        $this->create_error_message();
      }
      else
      {
        $this->create_success_message();
      }
      $this->c_html_page_content = $this->c_arr_page_content['html'];
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    // create an error page
    private function create_error_message()
    {
      $m_page_heading = 'Bit-level processing';
      $m_page_heading_2 = 'Results - input error';

      $this->c_arr_page_content['html'] = <<< HTMLBODY
<div id="page-content-div">
<h2>$m_page_heading</h2>
<h3>$m_page_heading_2</h3>
<p class="curr_page"></p>
<p class="curr_page">The integer you entered was not valid</p>
HTMLBODY;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function create_success_message()
    {
      $m_sanitised_value = $this->c_arr_page_content['validation_result']['sanitised_value'];
      $m_byte_to_analyse = $this->c_arr_page_content['bitwise_result']['byte-to-analyse'];
      $m_arr_bit_text = $this->c_arr_page_content['bitwise_result']['bit-text-array'];

      $m_bit_array = print_r($this->c_arr_page_content['bitwise_result']['bit-array'], true);

      $m_page_heading = 'Bit-level processing';
      $m_page_heading_2 = 'Results - bit-by-bit analysis';

      $this->c_arr_page_content['html'] = <<< HTMLBODY
<div id="page-content-div">
<h2>$m_page_heading</h2>
<h3>$m_page_heading_2</h3>
<p class="curr_page"></p>
<p class="curr_page">Entered value: $m_sanitised_value</p>
<p class="curr_page">Byte to analyse: $m_byte_to_analyse</p>
<p class="result">$m_bit_array</p>

<p class="curr_page">Test Results from Emergency Luminaire</p>
<ul>
	<li class="result">$m_arr_bit_text[0]</li>
	<li class="result">$m_arr_bit_text[1]</li>
	<li class="result">$m_arr_bit_text[2]</li>
	<li class="result">$m_arr_bit_text[3]</li>
	<li class="result">$m_arr_bit_text[4]</li>
	<li class="result">$m_arr_bit_text[5]</li>
	<li class="result">$m_arr_bit_text[6]</li>
	<li class="result">$m_arr_bit_text[7]</li>
</ul>
</div>
HTMLBODY;
    }

  }
?>
