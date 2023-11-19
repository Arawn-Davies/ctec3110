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
    public function __construct(){}

    public function __destruct(){}

    public static function doDefinitions()
    {
        define ('DIRSEP', DIRECTORY_SEPARATOR);
        define ('URLSEP', '/');
        $class_path = realpath(dirname(__FILE__));
        $class_path_array = explode(DIRSEP, $class_path, -1);
        $class_file_path = implode(DIRSEP, $class_path_array) . DIRSEP;

        $app_root_path = $_SERVER['PHP_SELF'];
        $app_root_path_array = explode(URLSEP, $app_root_path, -1);
        $app_root_path = implode(URLSEP, $app_root_path_array) . URLSEP;
        $css_path = 'css' . URLSEP;
        $css_file_name = 'bitwise.css';

        define ('CLASS_PATH', $class_file_path);
        define ('APP_ROOT_PATH', $app_root_path);
        define ('APP_NAME', 'Bitwise');
        define ('CSS_PATH' , $css_path);
        define ('CSS_FILE_NAME', $css_file_name);
    }
}