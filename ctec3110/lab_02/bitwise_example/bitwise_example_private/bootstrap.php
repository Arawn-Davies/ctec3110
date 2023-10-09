<?php
  /**
   * bootstrap.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * Each feature is hosted in its own directory. The __autoload function
   * iterates through an array of the directory names, looking for the required class.
   * If the class definition file is find, the class is then checked for correct instantiation.
   *
   * If there are any problems, the error class is instantiated for error processing
   * NB this could also be achieved by throwing an exception in a try-catch structure
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  include_once 'classes/bitwise_framework/class.BitwiseConfig.php';
  BitwiseConfig::do_definitions();
  $html_result = BitwiseContainer::make_bitwise_router();

// end of application code

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
  // For loading class files automatically
  function __autoload($p_class_name)
  {
    $m_error_count = 0;
    $m_file_exists = false;
    $m_class_exists = true;
    $m_file_name = 'class.' . $p_class_name . '.php';
    $m_arr_directories = array('bitwise_framework', 'bitwise_form', 'bitwise_result');

    foreach ($m_arr_directories as $m_directory)
    {
      $m_file_path_and_name = CLASS_PATH . $m_directory . DIRSEP . $m_file_name;
      if (file_exists($m_file_path_and_name))
      {
        $m_file_exists = true;
        break;
      }
    }

    if ($m_file_exists)
    {
      require_once $m_file_path_and_name;
      if (!class_exists($p_class_name))
      {
        $m_class_exists = false;
        $m_error_count += 1;
      }
    }
    else
    {
      $m_error_count++;
    }

    if ($m_error_count > 0)
    {
      if (!$m_file_exists)
      {
        $error_message = BitwiseContainer::make_bitwise_error('file-not-found-error');
      }
      if (!$m_class_exists)
      {
        $error_message = BitwiseContainer::make_bitwise_error('class-not-found-error');
      }

      BitwiseContainer::make_bitwise_process_output($error_message);
      exit;
    }
  }
?>
