<?php

namespace Santosdave\Amadeus\Flight;

class FlightOffer
{
    public  $resultCount;
    public  $resultDictionaries;
    public  $offer;

    public function __construct(
        $resultCount = null,
        $resultDictionaries = null,
        $offer = null
    ) {
        $this->resultCount = $resultCount;
        $this->resultDictionaries = $resultDictionaries;
        $this->offer = $offer;
    }

    public function getResultCount()
    {
        return $this->resultCount;
    }

    public function getResultDictionaries()
    {
        return $this->resultDictionaries;
    }

    public function getOffer()
    {
        return $this->offer;
    }
}
