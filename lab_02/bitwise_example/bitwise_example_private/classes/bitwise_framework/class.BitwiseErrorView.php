<<<<<<< HEAD
<?php
  /**
   * class.BitwiseErrorView.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into a single byte
   *
   * View class to create an output page displaying an error message if there
   * is a system error (if possible)
   *
   * This could be extended to record the error in a log file, and/or send emails,
   * SMS messages, etc
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseErrorView extends BitwiseWebPageTemplateView
  {
    private $c_error_type;
    private $c_error_message;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      parent::__construct();
      $this->c_error_type = '';
      $this->c_error_message = '';
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function set_error_type($p_error_type)
    {
      $this->c_error_type = $p_error_type;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function create_error_message()
    {
      $this->set_page_title();
      $this->select_error_message();
      $this->create_page_body();
      $this->create_web_page();
      $this->log_error_message();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function get_html_output()
    {
      return $this->c_html_page_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function set_page_title()
    {
      $this->c_page_title = 'Bitwise processing error...';
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function select_error_message()
    {
      switch ($this->c_error_type)
      {
        case 'file-not-found-error':
        case 'class-not-found-error':
        default:
          $m_error_message = 'Ooops - there was an internal error - please try again later';
          break;
      }
      $this->c_error_message = $m_error_message;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function log_error_message()
    {
      trigger_error('Error type is: ' . $this->c_error_type);
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function create_page_body()
    {
      $m_address = APP_ROOT_PATH;

      $m_page_heading = 'Bit-level processing';
      $m_page_heading_2 = 'System Error';

      $m_error_message = $this->c_error_message;
      $m_html_output = <<< HTML
<h2>$m_page_heading</h2>
<h3>$m_page_heading_2</h3>
<p>$m_error_message</p>
<p><a href="$m_address">Try again</a></p>
HTML;
      $this->c_html_page_content = $m_html_output;
    }
  }
?>
=======
<?php
  /**
   * class.BitwiseErrorView.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into a single byte
   *
   * View class to create an output page displaying an error message if there
   * is a system error (if possible)
   *
   * This could be extended to record the error in a log file, and/or send emails,
   * SMS messages, etc
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseErrorView extends BitwiseWebPageTemplateView
  {
    private $c_error_type;
    private $c_error_message;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      parent::__construct();
      $this->c_error_type = '';
      $this->c_error_message = '';
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function set_error_type($p_error_type)
    {
      $this->c_error_type = $p_error_type;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function create_error_message()
    {
      $this->set_page_title();
      $this->select_error_message();
      $this->create_page_body();
      $this->create_web_page();
      $this->log_error_message();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function get_html_output()
    {
      return $this->c_html_page_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function set_page_title()
    {
      $this->c_page_title = 'Bitwise processing error...';
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function select_error_message()
    {
      switch ($this->c_error_type)
      {
        case 'file-not-found-error':
        case 'class-not-found-error':
        default:
          $m_error_message = 'Ooops - there was an internal error - please try again later';
          break;
      }
      $this->c_error_message = $m_error_message;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function log_error_message()
    {
      trigger_error('Error type is: ' . $this->c_error_type);
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function create_page_body()
    {
      $m_address = APP_ROOT_PATH;

      $m_page_heading = 'Bit-level processing';
      $m_page_heading_2 = 'System Error';

      $m_error_message = $this->c_error_message;
      $m_html_output = <<< HTML
<h2>$m_page_heading</h2>
<h3>$m_page_heading_2</h3>
<p>$m_error_message</p>
<p><a href="$m_address">Try again</a></p>
HTML;
      $this->c_html_page_content = $m_html_output;
    }
  }
?>
>>>>>>> 5166bf7a3b833f0ae6c73436ea615f3c4c629f63
