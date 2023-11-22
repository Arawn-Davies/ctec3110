<<<<<<< HEAD
<?php
  /**
   * class.BitwiseResultModel.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * Model class to perform the requested calculation using the user-entered
   * value after validation and sanitisation
   *
   * The calculation iterates over each bit of the entered byte, masking each,
   * then performing an arithmetic shift right
   *
   * Bit result text is taken from the Thorlux Scanlight AT project
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseResultModel
  {
    private $c_validate_error_flag;
    private $c_value_to_analyse;
    private $c_arr_result;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      $this->c_validate_error_flag = false;
      $this->c_value_to_analyse = null;
      $this->c_arr_result = array();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function get_bitwise_result()
    {
      return $this->c_arr_result;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function set_bitwise_values($p_arr_bitwise_validate_result)
    {
      if ($p_arr_bitwise_validate_result['validate_error'])
      {
        $this->c_validate_error_flag = true;
      }
      else
      {
        $this->c_value_to_analyse = $p_arr_bitwise_validate_result['sanitised_value'];
      }
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_bitwise_processing()
    {
      $m_arr_process_result = array();
      $m_arr_process_result['byte-to-analyse'] = null;
      $m_arr_process_result['bit-array'] = null;

      if ($this->c_validate_error_flag)
      {
        $m_arr_process_result['process_error'] = true;
      }
      else
      {
        $m_number_to_analyse = $this->c_value_to_analyse;
        // display the byte as a string of bits
        $m_bit_mask = 1;
        $m_shift_step_size = 1;
        $m_bin_string = decbin($m_number_to_analyse);
        $m_bit_count = strlen($m_bin_string);
        $m_arr_bit = array();
        for ($m_lcv = 0; $m_lcv < $m_bit_count; $m_lcv++)
        {
          // logical AND the byte with the mask - store the result in the array
          $m_arr_bit[$m_lcv] = (int)$m_number_to_analyse & (int)$m_bit_mask;
          // arithmetic shift right
          $m_number_to_analyse = $m_number_to_analyse >> $m_shift_step_size;
        }

        // make up to 8 bits in result array
        $m_arr_bit = array_pad($m_arr_bit, 8, 0);
        // reverse the array order
        $m_arr_bit = array_reverse($m_arr_bit);
        // convert the array to a string for output screen
        $m_bin_string = implode(' ', $m_arr_bit);
        $m_arr_process_result['byte-to-analyse'] = $m_bin_string;
        $m_arr_process_result['bit-array'] = $m_arr_bit;
      }

      $m_arr_process_result['bit-text-array'] = $this->assign_text_to_bit($m_arr_process_result['bit-array']);
      $this->c_arr_result = $m_arr_process_result;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function assign_text_to_bit($p_arr_bits)
    {
      $m_arr_bit = $p_arr_bits;
      for ($m_lcv = 0; $m_lcv < 8; $m_lcv++)
      {
        switch ($m_lcv)
        {
          case '0':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 0: Circuit OK';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 0: Circuit failed';
            }
            break;
          case '1':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 1: Battery Duration OK';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 1: Battery Duration test failed';
            }
            break;
          case '2':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 2: Battery charge circuit OK';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 2: Battery charge circuit failed';
            }
            break;
          case '3':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 3: Lamp OK';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 3: Lamp failed';
            }
            break;
          case '6':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 6: Function test passed';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 6: Function test failed';
            }
            break;
          case '7':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 7: Duration test passed';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 7: Duration test failed';
            }
            break;
          default:
            $m_arr_bit_text[$m_lcv] = 'Bit ' . $m_lcv . ': Not used';
        }
      }
      return $m_arr_bit_text;
    }
  }
?>
=======
<?php
  /**
   * class.BitwiseResultModel.php
   *
   * Bitwise: PHP web application to demonstrate "bit chopping"
   * Each bit within a byte can be analysed to detect its state,
   * either true of false.  This technique can be used to pack lost of
   * information into  a single byte
   *
   * Model class to perform the requested calculation using the user-entered
   * value after validation and sanitisation
   *
   * The calculation iterates over each bit of the entered byte, masking each,
   * then performing an arithmetic shift right
   *
   * Bit result text is taken from the Thorlux Scanlight AT project
   *
   * @author CF Ingrams - cfi@dmu.ac.uk
   * @copyright De Montfort University
   *
   * @package bitwise
   */

  class BitwiseResultModel
  {
    private $c_validate_error_flag;
    private $c_value_to_analyse;
    private $c_arr_result;

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __construct()
    {
      $this->c_validate_error_flag = false;
      $this->c_value_to_analyse = null;
      $this->c_arr_result = array();
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function __destruct(){}

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function get_bitwise_result()
    {
      return $this->c_arr_result;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function set_bitwise_values($p_arr_bitwise_validate_result)
    {
      if ($p_arr_bitwise_validate_result['validate_error'])
      {
        $this->c_validate_error_flag = true;
      }
      else
      {
        $this->c_value_to_analyse = $p_arr_bitwise_validate_result['sanitised_value'];
      }
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    public function do_bitwise_processing()
    {
      $m_arr_process_result = array();
      $m_arr_process_result['byte-to-analyse'] = null;
      $m_arr_process_result['bit-array'] = null;

      if ($this->c_validate_error_flag)
      {
        $m_arr_process_result['process_error'] = true;
      }
      else
      {
        $m_number_to_analyse = $this->c_value_to_analyse;
        // display the byte as a string of bits
        $m_bit_mask = 1;
        $m_shift_step_size = 1;
        $m_bin_string = decbin($m_number_to_analyse);
        $m_bit_count = strlen($m_bin_string);
        $m_arr_bit = array();
        for ($m_lcv = 0; $m_lcv < $m_bit_count; $m_lcv++)
        {
          // logical AND the byte with the mask - store the result in the array
          $m_arr_bit[$m_lcv] = (int)$m_number_to_analyse & (int)$m_bit_mask;
          // arithmetic shift right
          $m_number_to_analyse = $m_number_to_analyse >> $m_shift_step_size;
        }

        // make up to 8 bits in result array
        $m_arr_bit = array_pad($m_arr_bit, 8, 0);
        // reverse the array order
        $m_arr_bit = array_reverse($m_arr_bit);
        // convert the array to a string for output screen
        $m_bin_string = implode(' ', $m_arr_bit);
        $m_arr_process_result['byte-to-analyse'] = $m_bin_string;
        $m_arr_process_result['bit-array'] = $m_arr_bit;
      }

      $m_arr_process_result['bit-text-array'] = $this->assign_text_to_bit($m_arr_process_result['bit-array']);
      $this->c_arr_result = $m_arr_process_result;
    }

// ~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*
    private function assign_text_to_bit($p_arr_bits)
    {
      $m_arr_bit = $p_arr_bits;
      for ($m_lcv = 0; $m_lcv < 8; $m_lcv++)
      {
        switch ($m_lcv)
        {
          case '0':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 0: Circuit OK';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 0: Circuit failed';
            }
            break;
          case '1':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 1: Battery Duration OK';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 1: Battery Duration test failed';
            }
            break;
          case '2':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 2: Battery charge circuit OK';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 2: Battery charge circuit failed';
            }
            break;
          case '3':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 3: Lamp OK';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 3: Lamp failed';
            }
            break;
          case '6':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 6: Function test passed';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 6: Function test failed';
            }
            break;
          case '7':
            if ($m_arr_bit[$m_lcv])
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 7: Duration test passed';
            }
            else
            {
              $m_arr_bit_text[$m_lcv] = 'Bit 7: Duration test failed';
            }
            break;
          default:
            $m_arr_bit_text[$m_lcv] = 'Bit ' . $m_lcv . ': Not used';
        }
      }
      return $m_arr_bit_text;
    }
  }
?>
>>>>>>> 5166bf7a3b833f0ae6c73436ea615f3c4c629f63
