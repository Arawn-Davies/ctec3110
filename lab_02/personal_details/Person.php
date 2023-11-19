<?php

// class to demonstrate getter & setter methods
class Person
{
    private $name;
    private $date_of_birth;

    public function __construct()
    {
        $this->name = '';
        $this->date_of_birth = '';
    }

    public function __destruct()
    {
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setDateOfBirth(int $month, int $day, int $year): void
    {
        if (checkdate($month, $day, $year))
        {
            $this->date_of_birth = $month . '/' . $day . '/' . $year;
        }
        else
            {
                trigger_error('Invalid date');
            }
    }

    public function getName(): string
    {
        $name = $this->name;
        return $name;
    }

    public function getDateOfBirth(): string
    {
        $date_of_birth = $this->date_of_birth;
        return $date_of_birth;
    }

    public function sayHello(): string
    {
        $message = '';
        if ($this->date_of_birth != '') {
            $message = '<p>Hello ' . $this->name . '. You were born on ' . $this->date_of_birth . '</p>';
        }
        return $message;
    }
}
