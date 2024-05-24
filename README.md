# Amadeus package for Laravel

Laravel package for Amadeus Self-Service Travel APIs

## Install with Composer

```php
composer require santosdave/amadeus
```

# Configuration

```php
  php artisan vendor:publish --provider='Santosdave\Amadeus\AmadeusProvider'

```

you will see `config/amadeus.php`. Replace the credentials

# How to use

#### Option 1

You can import in your required class by using ` use Santosdave\Amadeus\AmadeusProvider;`

#### Option 2

Add Amadeus in aliases under `config/app.php` file.
`'Amadeus'=> Santosdave\Amadeus\Amadeus::class' `

#### Now its Ready to use

```php
    $params=new stdClass();
    $params->origin='MAD';
    $params->destination='PAR';
    $params->departureDate='2020-04-01';
    $params->returnDate='2020-04-15';
    $result = Amadeus::flightLowFareSearch($params);
```

you can use The Amadeus Class anywhere you want it , in Controller or Blade File

Enjoy :)
