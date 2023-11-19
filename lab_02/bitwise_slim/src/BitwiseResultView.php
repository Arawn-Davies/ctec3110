<?php

/**
 * BitwiseResultView.php
 *
 * Bitwise: PHP web application to demonstrate "bit chopping"
 * Each bit within a byte can be analysed to detect its state,
 * either true of false.  This technique can be used to pack lost of
 * information into  a single byte
 *
 * View class for the result
 * Output depends upon success or failure message from the Model class.
 *
 * All view src extend the BitwiseWebPageTemplateView class to give
 * a consistent web page layout
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 *
 * @package bitwise
 */

class BitwiseResultView extends BitwiseWebPageTemplateView
{
    private $bitwise_result;
    public function __construct()
    {
        parent::__construct();
        $this->bitwise_result = [];
    }

    public function __destruct()
    {
    }

    public function setOutputValue($bitwise_result)
    {
        $this->bitwise_result = $bitwise_result;
    }

    public function createOutputPage()
    {
        $this->setPageTitle();
        $this->createRelevantMessage();
        $this->createWebPage();
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function setPageTitle()
    {
        $this->page_title = 'Bitwise Processing result...';
    }

    private function createRelevantMessage()
    {
        // select output page to create
        if ($this->bitwise_result['sanitised_value'] === false)
        {
            $result_message = $this->createErrorMessage();
        }
        else
        {
            $result_message = $this->createSuccessMessage();
        }
        $this->html_page_content = $result_message;
    }

    // create an error page
    private function createErrorMessage()
    {
        $page_heading = 'Bit-level processing';
        $page_heading_2 = 'Results - input error';
        $result_message = <<< HTMLBODY
<div id="page-content-div">
<h2>$page_heading</h2>
<h3>$page_heading_2</h3>
<p class="curr_page"></p>
<p class="curr_page">The integer you entered was not valid</p>
HTMLBODY;
        return $result_message;
    }

    private function createSuccessMessage()
    {
        $sanitised_value = $this->bitwise_result['sanitised_value'];
        $byte_to_analyse = $this->bitwise_result['byte-to-analyse'];
        $bit_text = $this->bitwise_result['bit-text-array'];
        $bit_array = print_r($this->bitwise_result['bit-array'], true);
        $page_heading = 'Bit-level processing';
        $page_heading_2 = 'Results - bit-by-bit analysis';
        $bitwise_result = <<< HTMLBODY
<div id="page-content-div">
<h2>$page_heading</h2>
<h3>$page_heading_2</h3>
<p class="curr_page"></p>
<p class="curr_page">Entered value: $sanitised_value</p>
<p class="curr_page">Byte to analyse: $byte_to_analyse</p>
<p class="result">$bit_array</p>

<p class="curr_page">Test Results from Emergency Luminaire</p>
<ul>
	<li class="result">$bit_text[0]</li>
	<li class="result">$bit_text[1]</li>
	<li class="result">$bit_text[2]</li>
	<li class="result">$bit_text[3]</li>
	<li class="result">$bit_text[4]</li>
	<li class="result">$bit_text[5]</li>
	<li class="result">$bit_text[6]</li>
	<li class="result">$bit_text[7]</li>
</ul>
</div>
HTMLBODY;
        return $bitwise_result;
    }
}
