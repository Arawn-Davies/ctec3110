<?php

class CheckPrimeModel
{
    private $guess;
    private $guess_result;
    public function __construct()
    {
        $this->guess_result = '';
        $this->guess = 0;
    }

    public function __destruct()
    {
    }

    public function setPrimeCheckValue($guess_prime)
    {
        $this->guess = $guess_prime;
    }

    public function primeCheck()
    {
        $guess = $this->guess;
        $count = 2;
        do {
            $remainder = $guess % $count;
            $count++;
        } while ($remainder != 0 and $count < $guess);
        if (($count < $guess) || ($guess == 0)) {
            $this->guess_result = false;
        } else {
            $this->guess_result = true;
        }
    }

    public function getPrimeCheckResult()
    {
        return $this->guess_result;
    }
}
