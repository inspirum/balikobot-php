# Definitons

The module contains several helper classes that contain most of the constants needed to work with the Balikobot API.

There are classes for country codes, currency codes, package options, shipper codes and service types:

- [**Inspirum\Balikobot\Definitions\Country**](../src/Definitions/Country.php)
- [**Inspirum\Balikobot\Definitions\Currency**](../src/Definitions/Currency.php)
- [**Inspirum\Balikobot\Definitions\Option**](../src/Definitions/Option.php)
- [**Inspirum\Balikobot\Definitions\ServiceType**](../src/Definitions/ServiceType.php)
- [**Inspirum\Balikobot\Definitions\Shipper**](../src/Definitions/Shipper.php)

```php
use Inspirum\Balikobot\Definitions\Shipper;

var_dump(Shipper::CP);
/*
  "cp"
*/

var_dump(Shipper::TOP_TRANS);
/*
  "toptrans"
*/

```

```php
use Inspirum\Balikobot\Definitions\ServiceType;

var_dump(ServiceType::DHL_EXPRESS_WORLDWIDE_12);
/*
  "4"
*/

var_dump(ServiceType::CP_NP);
/*
  "NP"
*/

var_dump(ServiceType::DPD_PRIVATE_SATURDAY);
/*
  "8"
*/
```

```php
use Inspirum\Balikobot\Definitions\Option;

var_dump(Option::ORDER_ID);
/*
  "real_order_id"
*/

var_dump(Option::CUSTOMER_NAME);
/*
  "rec_name"
*/
```

```php
use Inspirum\Balikobot\Definitions\Country;

var_dump(Country::AUSTRIA);
/*
  "AT"
*/
```

```php
use Inspirum\Balikobot\Definitions\Currency;

var_dump(Currency::PLN);
/*
  "PLN"
*/
```

These classes also contain static methods for accessing all constants for given type.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$shippers = Shipper::all();

/*
var_dump($shippers);
[
  0  => "cp"
  1  => "dhl"
  2  => "dpd"
  3  => "geis"
  4  => "gls"
  5  => "intime"
  6  => "pbh"
  7  => "ppl"
  8  => "sp"
  9  => "toptrans"
  10 => "ulozenka"
  11 => "zasilkovna"
]
*/
```


```php
use Inspirum\Balikobot\Definitions\ServiceType;

$services = ServiceType::all();

/*
var_dump($services);
[
  "cp" => [
    0 => "DR"
    1 => "RR"
    2 => "NP"
    3 => "DV"
    4 => "VL"
    ...
  ]
  "dpd" => [
    0 => "1"
    1 => "2"
    ...
  ]
  ...
]
*/
```

```php
use Inspirum\Balikobot\Definitions\ServiceType;

$services = ServiceType::topTrans();

/*
var_dump($services);
[
  0 => "1"
  1 => "2"
  2 => "3"
  3 => "4"
  4 => "5"
  5 => "6"
]
*/
```

Other, less used available methods:

```php
Country::all();
Country::validateCode("CZE");
Currency::all();
Currency::validateCode("RUB");
Shipper::validateCode("dpd");
Shipper::hasFullBranchesSupport("cp");
ServiceType::cp();
ServiceType::intime();

// and more ...
```

***


## More usage


### [**Client**](./client.md)

Support all options for Balikobot API described in given documentation.


### [**Balikobot**](./balikobot.md)

Extension over Client that uses custom DTO classes as an input and output for its methods.
