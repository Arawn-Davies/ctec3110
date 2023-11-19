<?php
  /**
   * class.BitwiseConfig.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * Configuration class: all file paths and other constants are
   * constructed and defined here
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseConfig
  {
// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public static function do_definitions()
    {
      define ('DIRSEP', DIRECTORY_SEPARATOR);
      define ('URLSEP', '/');
      $m_class_path = realpath(dirname(__FILE__));
      $m_arr_class_path = explode(DIRSEP, $m_class_path, -1);
      $m_class_file_path = implode(DIRSEP, $m_arr_class_path) . DIRSEP;

      $m_app_root_path = $_SERVER['PHP_SELF'];
      $m_arr_app_root_path = explode(URLSEP, $m_app_root_path, -1);
      $m_app_root_path = implode(URLSEP, $m_arr_app_root_path) . URLSEP;
      $m_css_path = 'css' . URLSEP;
      $m_css_file_name = 'bitwise.css';

      define ('CLASS_PATH', $m_class_file_path);
      define ('APP_ROOT_PATH', $m_app_root_path);
      define ('APP_NAME', 'Bitwise');
      define ('CSS_PATH' , $m_css_path);
      define ('CSS_FILE_NAME', $m_css_file_name);
    }
  }
?>
