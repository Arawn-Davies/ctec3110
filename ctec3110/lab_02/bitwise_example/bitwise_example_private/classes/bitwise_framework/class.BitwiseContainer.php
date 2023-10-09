<?php
  /**
   * class.BitwiseContainer.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * Container class to instantiate all other classes of the web application
   * The role of this class will be extended in future example applications

   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseContainer
  {
// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public static function make_bitwise_router()
    {
      $m_obj_router = new BitwiseRouter();
      $m_obj_router->do_routing();
      $m_html_result = $m_obj_router->get_html_output();
      return $m_html_result;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public static function make_bitwise_error($p_error_type)
    {
      $m_obj_error = new BitwiseErrorView();
      $m_obj_error->set_error_type($p_error_type);
      $m_error_message = $m_obj_error->get_html_output();
      return $m_error_message;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public static function make_bitwise_process_output($p_html_result)
    {
      $m_obj_process_output = new BitwiseProcessOutput();
      $m_obj_process_output->do_output($p_html_result);
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public static function make_bitwise_form_controller()
    {
      $m_obj_form_controller = new BitwiseFormController();
      $m_obj_form_controller->do_create_form();
      $m_html_output = $m_obj_form_controller->get_html_output();
      return $m_html_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public static function make_bitwise_form_view()
    {
      $m_obj_form_view = new BitwiseFormView();
      $m_obj_form_view->do_create_form();
      $m_html_output = $m_obj_form_view->get_html_output();
      return $m_html_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public static function make_bitwise_result_controller()
    {
      $m_obj_result_controller = new BitwiseResultController();
      $m_obj_result_controller->do_create_result();
      $m_html_output = $m_obj_result_controller->get_html_output();
      return $m_html_output;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public static function make_bitwise_result_validate()
    {
      $m_obj_result_validate = new BitwiseResultValidate();
      $m_obj_result_validate->do_sanitise_input();
      $m_sanitised_input = $m_obj_result_validate->get_sanitised_input();
      return $m_sanitised_input;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public static function make_bitwise_result_model($p_arr_sanitised_input)
    {
      $m_obj_result_model = new BitwiseResultModel();
      $m_obj_result_model->set_bitwise_values($p_arr_sanitised_input);
      $m_obj_result_model->do_bitwise_processing();
      $m_arr_bitwise_result = $m_obj_result_model->get_bitwise_result();
      return $m_arr_bitwise_result;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public static function make_bitwise_result_view($p_arr_page_content)
    {
      $m_obj_result_view = new BitwiseResultView();
      $m_obj_result_view->set_output_values($p_arr_page_content);
      $m_obj_result_view->create_output_page();
      $m_html_output = $m_obj_result_view->get_html_output();
      return $m_html_output;
    }
  }
?>
