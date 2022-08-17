# Definitons

The module contains several helper classes that contain most of the constants needed to work with the Balikobot API.

There are classes for country codes, currency codes, package options, carrier codes and service types:

- [**Attribute**](../src/Definitions/Attribute.php)
- [**Carrier**](../src/Definitions/Carrier.php)
- [**Country**](../src/Definitions/Country.php)
- [**Currency**](../src/Definitions/Currency.php)
- [**Method**](../src/Definitions/Method.php)
- [**Region**](../src/Definitions/Region.php)
- [**Service**](../src/Definitions/Service.php)
- [**Status**](../src/Definitions/Status.php)

```php
use Inspirum\Balikobot\Definitions\Carrier;

var_dump(Carrier::CP);
/*
'cp'
*/

var_dump(Carrier::TOPTRANS);
/*
'toptrans'
*/

```

```php
use Inspirum\Balikobot\Definitions\Service;

var_dump(Service::DHL_EXPRESS_WORLDWIDE_12);
/*
'4'
*/

var_dump(Service::CP_NP);
/*
'NP'
*/

var_dump(Service::DPD_PRIVATE_SATURDAY);
/*
'8'
*/
```

```php
use Inspirum\Balikobot\Definitions\Attribute;

var_dump(Attribute::REAL_ORDER_ID);
/*
'real_order_id'
*/

var_dump(Attribute::REC_NAME);
/*
'rec_name'
*/
```

```php
use Inspirum\Balikobot\Definitions\Country;

var_dump(Country::AUSTRIA);
/*
'AT'
*/
```

```php
use Inspirum\Balikobot\Definitions\Currency;

var_dump(Currency::PLN);
/*
'PLN'
*/
```

These classes also contain static methods for accessing all constants for given type.

```php
use Inspirum\Balikobot\Definitions\Carrier;

$carriers = Carrier::all();

/*
var_dump($carriers);
[
  0  => 'cp'
  1  => 'dhl'
  2  => 'dhlsk'
  3  => 'dpd'
  4  => 'geis'
  5  => 'gls'
  6  => 'intime'
  7  => 'pbh'
  8  => 'ppl'
  9  => 'sp'
  10 => 'toptrans'
  11 => 'ulozenka'
  12 => 'ups'
  13 => 'zasilkovna'
  14 => 'tnt'
]
*/
```

```php
use Inspirum\Balikobot\Definitions\Service;

$services = Service::getForCarriers();

/*
var_dump($services);
[
  'cp' => [
    0 => 'DR'
    1 => 'RR'
    2 => 'NP'
    3 => 'DV'
    4 => 'VL'
    ...
  ]
  'dpd' => [
    0 => '1'
    1 => '2'
    ...
  ]
  ...
]
*/
```

```php
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Service;

$services = Service::getForCarrier(Carrier::TOPTRANS);

/*
var_dump($services);
[
  0 => '1'
  1 => '2'
  2 => '3'
  3 => '4'
  4 => '5'
  5 => '6'
]
*/
```
