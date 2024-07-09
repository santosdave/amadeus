<?php

namespace Santosdave\Amadeus\Flight\Parsers;

use Santosdave\Amadeus\Flight\AdditionalService;
use Santosdave\Amadeus\Flight\Aircraft;
use Santosdave\Amadeus\Flight\Airline;
use Santosdave\Amadeus\Flight\Amenity;
use Santosdave\Amadeus\Flight\Arrival;
use Santosdave\Amadeus\Flight\Currency;
use Santosdave\Amadeus\Flight\Departure;
use Santosdave\Amadeus\Flight\Duration;
use Santosdave\Amadeus\Flight\FareDetails;
use Santosdave\Amadeus\Flight\Fee;
use Santosdave\Amadeus\Flight\FlightOffer;
use Santosdave\Amadeus\Flight\IncludedCheckedBags;
use Santosdave\Amadeus\Flight\Itinerary;
use Santosdave\Amadeus\Flight\Location;
use Santosdave\Amadeus\Flight\Operating;
use Santosdave\Amadeus\Flight\Price;
use Santosdave\Amadeus\Flight\PricingOptions;
use Santosdave\Amadeus\Flight\Segment;
use Santosdave\Amadeus\Flight\TravelerPricing;
use Santosdave\Amadeus\Flight\Trip;

class FlightOfferParser
{
    public static function parse($response)
    {

        $flightOffer = null;

        if (!empty($response->meta) && !empty($response->data) && !empty($response->dictionaries)) {

            $count = $response->meta->count ?? 0;
            $data = self::parseOffers($response->data ?? []);
            $dictionaries = self::parseDictionaries($response->dictionaries ?? null);

            $flightOffer = new FlightOffer(
                $count ?? 0,
                $dictionaries ?? null,
                $data ?? null
            );
        } else {
            $flightOffer = new FlightOffer(
                0,
                null,
                null
            );
        }
        return $flightOffer;
    }

    private static function parseDictionaries($dictionaries)
    {
        $locations = self::parseLocations($dictionaries->locations ?? null);
        $aircraft = self::parseAircraft($dictionaries->aircraft ?? null);
        $currencies = self::parseCurrencies($dictionaries->currencies ?? null);
        $carriers = self::parseCarriers($dictionaries->carriers ?? null);
        return (object) [
            'locations' => $locations,
            'aircraft' => $aircraft,
            'currencies' => $currencies,
            'carriers' => $carriers,
        ];
    }

    private static function parseLocations($locations)
    {
        $parsedLocations = [];
        foreach ($locations as $code => $location) {
            $parsedLocations[] = new Location(
                $location->cityCode,
                $location->countryCode,
                AirportParser::getCityNameByIataCode($location->cityCode ?? null),
            );
        }
        return $parsedLocations;
    }

    private static function parseAircraft($aircraft)
    {
        $parsedAircraft = [];
        foreach ($aircraft as $code => $name) {
            $parsedAircraft[] = new Aircraft($code, $name);
        }
        return $parsedAircraft;
    }

    private static function parseCurrencies($currencies)
    {
        $parsedCurrencies = [];
        foreach ($currencies as $code => $name) {
            $parsedCurrencies[] = new Currency($code, $name);
        }
        return $parsedCurrencies;
    }

    private static function parseCarriers($carriers)
    {
        $parsedCarriers = [];
        foreach ($carriers as $code => $name) {
            $parsedCarriers[] = new Airline($code, $name);
        }
        return $parsedCarriers;
    }

    private static function parseOffers($offers)
    {
        $parsedOffers = [];
        foreach ($offers as $trip) {
            $itineraries = self::parseItineraries($trip->itineraries);
            $price = self::parsePrice($trip->price);
            $pricingOptions = self::parsePricingOptions($trip->pricingOptions);
            $travelerPricings = self::parseTravelerPricings($trip->travelerPricings);

            $parsedOffers[] = new Trip(
                $trip->type ?? null,
                $trip->id ?? null,
                $trip->source ?? null,
                $trip->instantTicketingRequired ?? null,
                $trip->nonHomogeneous ?? null,
                $trip->oneWay ?? null,
                $trip->lastTicketingDate ?? null,
                $trip->lastTicketingDateTime ?? null,
                $trip->numberOfBookableSeats ?? null,
                $itineraries,
                $price,
                $pricingOptions,
                $trip->validatingAirlineCodes ?? null,
                $travelerPricings
            );
        }
        return $parsedOffers;
    }


    private static function parseItineraries($itineraries)
    {
        $parsedItineraries = [];
        foreach ($itineraries as $itinerary) {
            $segments = self::parseSegments($itinerary->segments);
            $duration =  new Duration($itinerary->duration ?? null);
            $parsedItineraries[] = new Itinerary($duration, $segments);
        }
        return $parsedItineraries;
    }

    private static function parseSegments($segments)
    {
        $parsedSegments = [];
        foreach ($segments as $segment) {
            $departure = new Departure(
                $segment->departure->iataCode ?? null,
                $segment->departure->terminal ?? null,
                $segment->departure->at ?? null,
                AirportParser::getCityNameByIataCode($segment->departure->iataCode ?? null),
                AirportParser::getAirportNameByIataCode($segment->departure->iataCode ?? null),
            );
            $arrival = new Arrival(
                $segment->arrival->iataCode ?? null,
                $segment->arrival->terminal ?? null,
                $segment->arrival->at ?? null,
                AirportParser::getCityNameByIataCode($segment->arrival->iataCode ?? null),
                AirportParser::getAirportNameByIataCode($segment->arrival->iataCode ?? null),
            );
            $aircraft = new Aircraft($segment->aircraft->code); // Reusing Aircraft class
            // $operating = new Operating($segment->carrierCode);
            $duration =  new Duration($segment->duration ?? null);
            $parsedSegments[] = new Segment(
                $departure,
                $arrival,
                $segment->carrierCode ?? null,
                $segment->number ?? null,
                $aircraft,
                $duration,
                $segment->id ?? null,
                $segment->numberOfStops ?? null,
                $segment->blacklistedInEU
            );
        }
        return $parsedSegments;
    }


    private static function parsePrice($price)
    {
        $fees = [];
        if (isset($price->fees)) {
            foreach ($price->fees as $fee) {
                $fees[] = new Fee($fee->amount ?? null, $fee->type ?? null);
            }
        }


        $additionalServices = [];
        if (isset($price->additionalServices)) {
            foreach ($price->additionalServices as $service) {
                $additionalServices[] = new AdditionalService($service->amount ?? null, $service->type ?? null);
            }
        }


        return new Price(
            $price->currency ?? null,
            $price->total ?? null,
            $price->base ?? null,
            $fees,
            $price->grandTotal ?? null,
            $additionalServices
        );
    }

    private static function parsePricingOptions($pricingOptions)
    {
        return new PricingOptions(
            $pricingOptions->fareType ?? null,
            $pricingOptions->includedCheckedBagsOnly ?? null
        );
    }

    private static function parseTravelerPricings($travelerPricings)
    {
        $parsedTravelerPricings = [];
        foreach ($travelerPricings as $travelerPricing) {
            $fareDetails = [];
            if (isset($travelerPricing->fareDetailsBySegment)) {
                foreach ($travelerPricing->fareDetailsBySegment as $fareDetail) {
                    $includedCheckedBags = new IncludedCheckedBags($fareDetail->includedCheckedBags->quantity ?? null);
                    $amenities = [];
                    if (isset($fareDetail->amenities)) {
                        foreach ($fareDetail->amenities as $amenity) {
                            $amenities[] = new Amenity(
                                $amenity->description ?? null,
                                $amenity->isChargeable ?? null,
                                $amenity->amenityType ?? null,
                                $amenity->amenityProvider ?? null,
                            );
                        }
                    }

                    $fareDetails[] = new FareDetails(
                        $fareDetail->segmentId ?? null,
                        $fareDetail->cabin ?? null,
                        $fareDetail->fareBasis ?? null,
                        $fareDetail->brandedFare ?? null,
                        $fareDetail->brandedFareLabel ?? null,
                        $fareDetail->class ?? null,
                        $includedCheckedBags,
                        $amenities // Assuming amenities is an array of objects
                    );
                }
            }
            $parsedTravelerPricings[] = new TravelerPricing(
                $travelerPricing->travelerId ?? null,
                $travelerPricing->fareOption ?? null,
                $travelerPricing->travelerType ?? null,
                self::parsePrice($travelerPricing->price ?? null), // Assuming price structure is the same
                $fareDetails
            );
        }
        return $parsedTravelerPricings;
    }
}