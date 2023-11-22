<?php
  /**
   * class.BitwiseWebPageTemplateView.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * Parent view class
   * The class is extended by the view class of each feature to give
   * a consistent web page layout.
   *
   * NB shared methods would normally be set to final unless they need to be
   * overridden in the child class
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseWebPageTemplateView
  {
    protected $c_page_title;
    protected $c_html_page_content;
    protected $c_html_page_output;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      $this->c_page_title = '';
      $this->c_html_page_content = '';
      $this->c_html_page_output = '';
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    protected final function create_web_page()
    {
      $this->create_web_page_meta_headings();
      $this->insert_page_content();
      $this->create_web_page_footer();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function create_web_page_meta_headings()
    {
      $m_css_filename = CSS_PATH . CSS_FILE_NAME;
      $m_html_output = <<< HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="en-gb" />
	<meta name="author" content="Clinton Ingrams" />
	<link rel="stylesheet" href="$m_css_filename" type="text/css" />
	<title>$this->c_page_title</title>
</head>
<body>
HTML;
      $this->c_html_page_output .= $m_html_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function insert_page_content()
    {
      $m_landing_page = APP_ROOT_PATH;
      $m_html_output = <<< HTML
<div id="banner-div">
<h1>Bitwise Processing</h1>
<p class="cent">
Page last updated on <script type="text/javascript">document.write(document.lastModified)</script>
<br />
Maintained by <a href="mailto:cfi@dmu.ac.uk">cfi@dmu.ac.uk</a>
</p>
<hr class="deepline"/>
</div>
<div id="clear-div"></div>
<div id="page-content-div">
$this->c_html_page_content
<p class="curr_page"><a href="$m_landing_page">Enter another integer</a></p>
</div>
HTML;
      $this->c_html_page_output .= $m_html_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function create_web_page_footer()
    {
      $m_html_output = <<< HTML
</body>
</html>
HTML;
      $this->c_html_page_output .= $m_html_output;
    }
  }
?>
