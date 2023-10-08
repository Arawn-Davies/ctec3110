<?php

// PetName.php
declare(strict_types=1);

class PetName
{
    private string $pet_name;
    
    public function __construct(){}
    
    public function __destruct(){}

    public function setPetName($pet_name_to_store)
    {
        $this->pet_name = $pet_name_to_store;
    }
    public function getPetName(): string
    {
        return $this->pet_name;
    }
}
