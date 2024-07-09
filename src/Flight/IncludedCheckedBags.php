<?php

namespace Santosdave\Amadeus\Flight;

class IncludedCheckedBags
{
    public $quantity;


    public function __construct($quantity = null)
    {
        $this->quantity = $quantity;
    }
}