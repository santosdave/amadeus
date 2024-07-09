<?php

namespace Santosdave\Amadeus\Flight;

class Airline
{
    public $code;
    public $name;

    public function __construct($code = null, $name = null)
    {
        $this->code = $code;
        $this->name = $name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getName()
    {
        return $this->name;
    }
}