<?php
/**
 * class to demonstrate overloaded getter & setter methods
 * Uses the magic methods __get & __set to access attributes
 *
 * Accepts two attributes: name & date_of_birth
 *
 * Also uses call_user_func(): calls a user defined function with the first
 * parameter as the function name
 *
 * Class could be updated to accept any attribute name
 */

class Person
{
    private $name;
    private $date_of_birth;

    public function __construct()
    {
        $this->name = '';
        $this->date_of_birth = '';
    }

    public function __destruct() {}

    /**
     * Validates a name and stores non-blank strings
     * @param $name_to_store
     * @return void
     */
    public function setName($name_to_store)
    {
        if ($name_to_store <> '')
        {
            $this->name = $name_to_store;
        }
    }

    /**
     * Validates a date of birth  - throws an exception if not a valid date
     * @param $dob_to_store
     * @return void
     */
    public function setDoB($dob_to_store)
    {
        if ($dob_to_store <> '')
        {
            try
            {
                if (strtotime($dob_to_store))
                {
                    $this->date_of_birth = $dob_to_store;
                }
                else {
                    throw new Exception('Invalid date entered');
                }
            }
            catch (Exception $m_err)
            {
                trigger_error('<p>Caught exception: ' . $m_err->getMessage());
            }
        }
    }


    /**
     * Create the output from the class and return it
     */
    public function sayHello(): string
    {
        $message = '';
        if ($this->date_of_birth != '')
        {
            $message  = '<p>Hello ' . $this->name;
            $message .= '. You were born on ' . $this->date_of_birth . '</p>';
            $message .= '<p></p>';
        }
        return $message;
    }
}
