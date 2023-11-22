<?php

/** a view class
 * takes generated content and embeds it within HTML script
 */

class View
{
    private $output_html;
    private $input_content;
    private $page_title;

    public function __construct()
    {
        $this->output_html = '';
        $this->input_content = [];
        $this->page_title = '';
    }

    public function __destruct(){}

    /**
     * set the title of the web-page
     */
    public function setPageTitle(string $page_title): void
    {
        $this->page_title = $page_title;
    }

    /**
     * set the generated content
     */
    public function setPageContent(array $page_content): void
    {
        $this->input_content = $page_content;
    }

    /**
     * The output is passed as an array, so need to read the
     * array elements into local variables, before embedding
     * the generated content into the html
     */
    public function createHtmlContent()
    {
        $output_1 = $this->input_content[1];
        $output_2 = $this->input_content[2];
        $this->output_html = <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
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
    public function getOutputHtml(): string
    {
        return $this->output_html;
    }
}
