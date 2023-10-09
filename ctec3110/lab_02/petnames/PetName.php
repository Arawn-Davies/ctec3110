<?php

//namespace Petnames;

class PetName
{
    // declare an attribute variable
    private $pet_name;

    public function __construct()
    {
        $this->pet_name = '';
    }

    public function __destruct()
    {
    }

    public function setPetName($pet_name_to_store)
    {
        $this->pet_name = $pet_name_to_store;
    }

    public function getPetName()
    {
        return $this->pet_name;
    }
}
