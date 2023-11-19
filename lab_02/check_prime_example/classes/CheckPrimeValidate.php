<?php

/** sanitise and validate the entered number
 */
class CheckPrimeValidate
{
    private $tainted;
    private $cleaned;

    public function __construct()
    {
        $this->tainted = [];
        $this->cleaned = [];
    }

    public function __destruct()
    {
    }

    public function sanitiseInput()
    {
        $this->tainted = $_POST;
        $this->cleaned['check_prime_error'] = false;
        $guess = $this->tainted['guess_prime'];

        if (empty($guess) || !is_numeric($guess) || $guess <= 1)
        {
            $this->cleaned['check_prime_error'] = true;
        }
        else
        {
            $this->cleaned['check_prime_validated'] = $guess;
        }
    }

    public function getValidatedPrimeCheck()
    {
        return $this->cleaned;
    }
}
