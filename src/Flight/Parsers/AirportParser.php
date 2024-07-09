<?php

namespace Santosdave\Amadeus\Flight\Parsers;

class AirportParser
{
    public static function getCityNameByIataCode($iataCode = null)
    {
        // Load airports.json file
        $filename = __DIR__ . '/../airports.json';

        if (file_exists($filename) && $iataCode) {

            $json = file_get_contents($filename);

            // Parse JSON into PHP array
            $airports = json_decode($json, true);

            // Find city name by IATA code
            foreach ($airports as $airport) {
                if ($airport['cityCode'] === $iataCode) {
                    return $airport['cityName'] ?? null;
                }
            }
        }
        return null; // Return null if IATA code not found
    }
    public static function getAirportNameByIataCode($iataCode = null)
    {
        // Load airports.json file
        $filename = __DIR__ . '/../airports.json';

        if (file_exists($filename) && $iataCode) {

            $json = file_get_contents($filename);

            // Parse JSON into PHP array
            $airports = json_decode($json, true);

            // Find city name by IATA code
            foreach ($airports as $airport) {
                if ($airport['code'] === $iataCode) {
                    return $airport['name'] ?? null;
                }
            }
        }
        return null; // Return null if IATA code not found
    }
}