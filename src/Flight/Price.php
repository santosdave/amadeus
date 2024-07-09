<?php

namespace Santosdave\Amadeus\Flight;

class Price
{
    public $currency;
    public $total;
    public $base;
    public $fees;
    public $grandTotal;
    public $additionalServices;

    public function __construct($currency = null, $total = null, $base = null, $fees = null, $grandTotal = null, $additionalServices = null)
    {
        $this->currency = $currency;
        $this->total = $total;
        $this->base = $base;
        $this->fees = $fees;
        $this->grandTotal = $grandTotal;
        $this->additionalServices = $additionalServices;
    }
}