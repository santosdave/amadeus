<?php

namespace Santosdave\Amadeus;

interface AmadeusLogger
{
    public function log($type, $request, $content);
}