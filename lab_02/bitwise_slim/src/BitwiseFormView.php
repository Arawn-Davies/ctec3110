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
 * All view src extend the BitwiseWebPageTemplateView class to give
 * a consistent web page layout
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 *
 * @package bitwise
 */

class BitwiseFormView extends BitwiseWebPageTemplateView
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
    }

    public function createForm()
    {
        $this->setPageTitle();
        $this->createPageBody();
        $this->createWebPage();
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function setPageTitle()
    {
        $this->page_title = 'Bitwise Form';
    }

    private function createPageBody()
    {
        $input_box_value = null;
        $page_heading = 'Bit-level processing';
        $page_heading_2 = 'Enter an integer in the range 0 - 255';
        $html_output = <<< HTMLFORM
<h2>$page_heading</h2>
<h3>$page_heading_2</h3>
<p class="curr_page"></p>
<form action="calculateresult" method="post">
	<input type="hidden" name="feature" value="display-result">
	<fieldset>
	<legend>Integer for Bit analysis</legend>
		<label for="integer_to_analyse">Enter your integer for analysis:</label>
		<input id="integer_to_analyse" name="integer_to_analyse" type="text"
			value="$input_box_value" size="30" maxlength="4">
		<input type="submit" value="Analyse the integer >>>">
	</fieldset>
</form>
HTMLFORM;
        $this->html_page_content = $html_output;
    }
}
