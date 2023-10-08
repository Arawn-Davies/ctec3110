<?php
/**
 * PersonView class coupled with the Person class
 *
 * Takes generated content as an array and embeds it within HTML script
 */
class PersonView
{
	private $output_html;
	private $input_content;
	private $page_title;

	public function __construct()
	{
		$this->output_html = '';
		$this->input_content = '';
		$this->page_title = '';
	}

	public function __destruct() {}

	/**
	 * Set the title of the web-page
	 * Accepts the title for the web-page and assigns it to an
	 * attribute variable
	 *
	 * @param $page_title: accept the page title string
	 */
	public function setPageTitle($page_title)
	{
		$this->page_title = $page_title;
	}

	/**
	 * Set the generated content
	 *
	 * Accepts the content of the page and assigns it to an attribute variable
	 *
	 * @param $page_content: accept the page content as a string
	 */
	public function setPageContent($page_content)
	{
		$this->input_content = $page_content;
	}

	/**
	 * The output is passed to the class as an array, so we need
	 * to read the array elements into local variables, before
	 * embedding the generated content into the html
	 */
	private function create_html_page()
	{
		$output = '';
		
		
		$output_1 = $this->input_content[1];
		if (isset($this->input_content[2]))
		{
			$output_2 = $this->input_content[2];
		}
		else
		{
			$output_2 = '';
		}
		
		//$output_2 = $this->input_content[2];

		$this->output_html = <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>$this->page_title</title>
</head>
<body>
	<h1>Testing the Person class</h1>
	<p>$output_1</p>
	<p>$output_2</p>
</body>
</html>
HTML;
	}

	/**
	 * Return the completed HTML web-page
	 * This cheats a bit and actually generates the html!
	 */
	public function getOutputHtml()
	{
		$this->create_html_page();
		return $this->output_html;
	}
}

