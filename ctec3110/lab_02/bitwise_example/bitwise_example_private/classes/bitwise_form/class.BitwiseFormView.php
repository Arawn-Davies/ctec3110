<?php
  /**
   * class.BitwiseFormView.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * View class for the initial client form
   *
   * All view classes extend the BitwiseWebPageTemplateView class to give
   * a consistent web page layout
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseFormView extends BitwiseWebPageTemplateView
  {

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      parent::__construct();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_create_form()
    {
      $this->set_page_title();
      $this->create_page_body();
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
      $this->c_page_title = 'Bitwise Form';
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function create_page_body()
    {
      $m_address = APP_ROOT_PATH;
      $m_input_box_value = null;

      $m_page_heading = 'Bit-level processing';
      $m_page_heading_2 = 'Enter an integer in the range 0 - 255';
      $m_html_output = <<< HTMLFORM
<h2>$m_page_heading</h2>
<h3>$m_page_heading_2</h3>
<p class="curr_page"></p>
<form action="index.php" method="post">
	<input type="hidden" name="feature" value="display-result" />
	<fieldset>
	<legend>Integer for Bit analysis</legend>
		<label for="integer_to_analyse">Enter your integer for analysis:</label>
		<input id="integer_to_analyse" name="integer_to_analyse" type="text"
			value="$m_input_box_value" size="30" maxlength="4" />
		<input type="submit" value="Analyse the integer >>>" />
	</fieldset>
</form>
HTMLFORM;
      $this->c_html_page_content = $m_html_output;
    }
  }
?>
