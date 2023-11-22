<<<<<<< HEAD
<?php
  /**
   * class.BitwiseRouter.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * Router class: maps the user-sourced feature name to an internal feature name
   * Then calls the relevant Controller class via its container function
   *
   * If the class definition file is not found, the Error class is invoked
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseRouter
  {
    private $c_feature_in;
    private $c_feature;
    private $c_html_output;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      $this->c_feature_in = '';
      $this->c_feature = '';
      $this->c_html_output = '';
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_routing()
    {
      $this->set_feature_name();
      $this->map_feature_name();
      $this->router_class();
      BitwiseContainer::make_bitwise_process_output($this->c_html_output);
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function get_html_output()
    {
      return $this->c_html_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function set_feature_name()
    {
      if (isset($_POST['feature']))
      {
        $m_feature_in = $_POST['feature'];
      }
      else
      {
        if (isset($_GET['feature']))
        {
          $m_feature_in = $_GET['feature'];
        }
        else
        {
          $m_feature_in = 'index';
        }
      }

      $this->c_feature_in = $m_feature_in;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function map_feature_name()
    {
      $m_feature_exists = false;
      // map the passed module name to an internal application feature name
      $m_features = array(
        'index' => 'form',
        'display-result' => 'result'
      );

      if (array_key_exists($this->c_feature_in, $m_features))
      {
        $this->c_feature = $m_features[$this->c_feature_in];
        $m_feature_exists =  true;
      }
      else
      {
        $m_obj_bitwise_error = BitwiseContainer::make_bitwise_error('file-not-found-error');
      }
      return $m_feature_exists;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function router_class()
    {
      switch ($this->c_feature)
      {
        case 'result':
          $this->c_html_output = BitwiseContainer::make_bitwise_result_controller();
          break;
        case 'form':
        default:
          $this->c_html_output = BitwiseContainer::make_bitwise_form_controller();
          break;
      }
    }
  }
?>
=======
<?php
  /**
   * class.BitwiseRouter.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * Router class: maps the user-sourced feature name to an internal feature name
   * Then calls the relevant Controller class via its container function
   *
   * If the class definition file is not found, the Error class is invoked
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseRouter
  {
    private $c_feature_in;
    private $c_feature;
    private $c_html_output;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      $this->c_feature_in = '';
      $this->c_feature = '';
      $this->c_html_output = '';
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_routing()
    {
      $this->set_feature_name();
      $this->map_feature_name();
      $this->router_class();
      BitwiseContainer::make_bitwise_process_output($this->c_html_output);
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function get_html_output()
    {
      return $this->c_html_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function set_feature_name()
    {
      if (isset($_POST['feature']))
      {
        $m_feature_in = $_POST['feature'];
      }
      else
      {
        if (isset($_GET['feature']))
        {
          $m_feature_in = $_GET['feature'];
        }
        else
        {
          $m_feature_in = 'index';
        }
      }

      $this->c_feature_in = $m_feature_in;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function map_feature_name()
    {
      $m_feature_exists = false;
      // map the passed module name to an internal application feature name
      $m_features = array(
        'index' => 'form',
        'display-result' => 'result'
      );

      if (array_key_exists($this->c_feature_in, $m_features))
      {
        $this->c_feature = $m_features[$this->c_feature_in];
        $m_feature_exists =  true;
      }
      else
      {
        $m_obj_bitwise_error = BitwiseContainer::make_bitwise_error('file-not-found-error');
      }
      return $m_feature_exists;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function router_class()
    {
      switch ($this->c_feature)
      {
        case 'result':
          $this->c_html_output = BitwiseContainer::make_bitwise_result_controller();
          break;
        case 'form':
        default:
          $this->c_html_output = BitwiseContainer::make_bitwise_form_controller();
          break;
      }
    }
  }
?>
>>>>>>> 5166bf7a3b833f0ae6c73436ea615f3c4c629f63
