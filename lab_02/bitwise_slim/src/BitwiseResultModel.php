<?php
/**
 * BitwiseResultModel.php
 *
 * Bitwise: PHP web application to demonstrate "bit chopping"
 * Each bit within a byte can be analysed to detect its state,
 * either true of false.  This technique can be used to pack lots of
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
    private $value_to_analyse;
    private $result;

    public function __construct()
    {
        $this->value_to_analyse = null;
        $this->result = [];
    }

    public function __destruct(){}

    public function getBitwiseResult()
    {
        return $this->result;
    }

    public function setBitwiseValue($validated_byte)
    {
        $this->value_to_analyse = $validated_byte;
    }

    public function doBitwiseProcessing()
    {
        $process_result = [];
        $process_result['sanitised_value'] = $this->value_to_analyse;
        $process_result['byte-to-analyse'] = null;
        $process_result['bit-array'] = null;

        $number_to_analyse = $this->value_to_analyse;
        // display the byte as a string of bits
        $bit_mask = 1;
        $shift_step_size = 1;
        $bin_string = decbin($number_to_analyse);
        $bit_count = strlen($bin_string);
        $bit_array = [];
        for ($lcv = 0; $lcv < $bit_count; $lcv++)
        {
            // logical AND the byte with the mask - store the result in the array
            $bit_array[$lcv] = (int)$number_to_analyse & (int)$bit_mask;
            // arithmetic shift right
            $number_to_analyse = $number_to_analyse >> $shift_step_size;
        }

        // make up to 8 bits in result array
        $bit_array = array_pad($bit_array, 8, 0);
        // reverse the array order
        $bit_array = array_reverse($bit_array);
        // convert the array to a string for output screen
        $bin_string = implode(' ', $bit_array);
        $process_result['byte-to-analyse'] = $bin_string;
        $process_result['bit-array'] = $bit_array;

        $process_result['bit-text-array'] = $this->assignTextToBit($process_result['bit-array']);
        $this->result = $process_result;
    }

    private function assignTextToBit($bit_array)
    {
        $bit_text_array = [];
        for ($lcv = 0; $lcv < 8; $lcv++)
        {
            switch ($lcv)
            {
                case '0':
                    if ($bit_array[$lcv])
                    {
                        $bit_text_array[$lcv] = 'Bit 0: Circuit OK';
                    }
                    else
                    {
                        $bit_text_array[$lcv] = 'Bit 0: Circuit failed';
                    }
                    break;
                case '1':
                    if ($bit_array[$lcv])
                    {
                        $bit_text_array[$lcv] = 'Bit 1: Battery Duration OK';
                    }
                    else
                    {
                        $bit_text_array[$lcv] = 'Bit 1: Battery Duration test failed';
                    }
                    break;
                case '2':
                    if ($bit_array[$lcv])
                    {
                        $bit_text_array[$lcv] = 'Bit 2: Battery charge circuit OK';
                    }
                    else
                    {
                        $bit_text_array[$lcv] = 'Bit 2: Battery charge circuit failed';
                    }
                    break;
                case '3':
                    if ($bit_array[$lcv])
                    {
                        $bit_text_array[$lcv] = 'Bit 3: Lamp OK';
                    }
                    else
                    {
                        $bit_text_array[$lcv] = 'Bit 3: Lamp failed';
                    }
                    break;
                case '6':
                    if ($bit_array[$lcv])
                    {
                        $bit_text_array[$lcv] = 'Bit 6: Function test passed';
                    }
                    else
                    {
                        $bit_text_array[$lcv] = 'Bit 6: Function test failed';
                    }
                    break;
                case '7':
                    if ($bit_array[$lcv])
                    {
                        $bit_text_array[$lcv] = 'Bit 7: Duration test passed';
                    }
                    else
                    {
                        $bit_text_array[$lcv] = 'Bit 7: Duration test failed';
                    }
                    break;
                default:
                    $bit_text_array[$lcv] = 'Bit ' . $lcv . ': Not used';
            }
        }
        return $bit_text_array;
    }
}
