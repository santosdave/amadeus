<?php

namespace Santosdave\Amadeus\Flight;

class PricingOptions
{
    public $fareType;
    public $includedCheckedBagsOnly;

    public function __construct($fareType = null, $includedCheckedBagsOnly = null)
    {
        $this->fareType = $fareType;
        $this->includedCheckedBagsOnly = $includedCheckedBagsOnly;
    }
}