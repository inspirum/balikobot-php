# Client

Support all options for Balikobot API described in given [documentation version](../README.md#version).

Class [**Inspirum\Balikobot\Services\Client**](../src/Services/Client.php) is wrapper for all available requests in Balikobot API. Every method is documented in the next [section](#requests).

Client class has two required arguments – API user and API key. 
These credentials can be found in the Balikobot administration (section *"Profil expedičního místa"*).

```php
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Services\Requester;

$apiUser = getenv('BALIKOBOT_API_USER');
$apiKey  = getenv('BALIKOBOT_API_KEY');

$client = new Client(new Requester($apiUser, $apiKey, sslVerify: true));
```


## Exceptions

The client handles the API responses and throws an exception when an error occurs. 
All thrown exceptions implement [**Inspirum\Balikobot\Contracts\ExceptionInterface**](../src/Contracts/ExceptionInterface.php) interface.
Thrown exception include error message, API response and any validation messages (even if **return_full_errors** option is not set).

```php
use Inspirum\Balikobot\Definitions\Shipper;

// unhandled client call with wrong data
$client->getOverview(Shipper::CP);

/*
PHP Fatal error: Uncaught Inspirum\Balikobot\Exceptions\UnauthorizedException: 
'Unauthorized - nejspíš chyba na straně Balikobotu'

'statusCode' => 401
'errors'     => []
'response'   => []
*/
```

Usually you will get [**Inspirum\Balikobot\Exceptions\BadRequestException**](../src/Exceptions/BadRequestException.php) 

```php
use Inspirum\Balikobot\Definitions\Shipper;

// unhandled client call with wrong data
$orderedPackages = $client->addPackages(Shipper::CP, $packages);

/*
PHP Fatal error: Uncaught Inspirum\Balikobot\Exceptions\BadRequestException: 
'Operace neproběhla v pořádku, zkontrolujte konkrétní data'

'statusCode' => 400
'errors'     => [
   0 => [
     'rec_email' => 'Nedorazil email příjemce.'
     'rec_phone' => 'Nedorazilo telefonní číslo příjemce.'
   ]
   1 => [
     'service_type' => 'Neznámé ID služby přepravce.'
   ]
]
'response'   => [
  0 => [
    'rec_email' => '406'
    'rec_phone' => '406'
  ]
  1 => [
    'service_type' => '413'
  ]
  'status' => '400'
]
*/
```

**Recommended**: Every client API call should be wrap in `try/catch` block to handle thrown exceptions.

```php
use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Definitions\Shipper;

try {
  // handled client call with wrong data
  $orderedPackages = $client->addPackages(Shipper::CP, $packages);
  // more logic ...
} catch(ExceptionInterface $exception) {
  // handle exception ...
}
```


## Requests

Client normalize Balikobot API response output to use the same format for any shipper (for example different response type for [**ZIPCODE**](#zipcodes) or [**BRANCHES**](#branches) requests).


### **ADD**

The **addPackages** method is used to add new packages for given shipper. All available options are in [**Inspirum\Balikobot\Definitions\Option**](../src/Definitions/Option.php) class.
 
The client normalizes the response by returning only added packages data (drop **status** and **labels_url** attribute).

```php
use Inspirum\Balikobot\Definitions\Option;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$orderedPackages = $client->addPackages(Shipper::CP, [
  [
    Option::SERVICE_TYPE  => ServiceType::CP_NP,
    Option::REAL_ORDER_ID => '180001',
    Option::ORDER_NUMBER  => 1,
    Option::REC_NAME      => 'Josef Novák',
    Option::PRICE         => 1500,
    // ...
  ],
  [
    Option::SERVICE_TYPE  => ServiceType::CP_NP,
    Option::REAL_ORDER_ID => '180001',
    Option::ORDER_NUMBER  => 2,
    Option::REC_NAME      => 'Josef Novák',
    Option::PRICE         => 2000,
    // ...
  ],
  // ...
]);

/*
var_dump($orderedPackages);
[
  0 => [
    'carrier_id' => 'NP1504102246M'
    'package_id' => '42719'
    'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.'
    'status'     => '200'
  ]
  1 => [
    'carrier_id' => 'NP1504102247M'
    'package_id' => '42720'
    'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.'
    'status'     => '200'
  ]
]
*/
```


### **DROP**

Drop created packages from Balikobot with **dropPackage** or **dropPackages** method. 

These methods has no return value, only throws exception on error.  

```php
use Inspirum\Balikobot\Definitions\Shipper;

$client->dropPackage(Shipper::CP, 42719);
```

```php
use Inspirum\Balikobot\Definitions\Shipper;

$client->dropPackages(Shipper::CP, [42719, 42720]);
```


### **TRACK**

Track added package status with **trackPackage** method. This method has shipper code and carrier ID as arguments. 
Carrier ID is from [**ADD**](#add) request response.

This method internally uses new **TRACK V3** request with better response data format. 
Response return only **status_id_v2** as **status_id** (you can always cast `float` to `int` to get older status ID) and use **name_internal** instead of **name_balikobot**. 

Older versions (**TRACK V2**, **TRACK V1**) are not longer available via this client.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$statuses = $client->trackPackage(Shipper::CP, 'NP1504102246M');

/*
var_dump($statuses);
[
  0 => [
    'date'          => '2018-07-02 00:00:00'
    'name'          => 'Dodání zásilky. 10003 Depo Praha 701'
    'name_internal' => 'Zásilka byla doručena příjemci.'
    'status_id'     => 1.2
    'type'          => 'event'
  ]
  1 => [
    'date'          => '2018-07-02 08:00:00'
    'name'          => 'E-mail adresátovi - zásilka převzata do přepravy.'
    'name_internal' => 'Zásilka je v přepravě'
    'status_id'     => 2.2
    'type'          => 'notification'
  ]
  2 => [
    'date'          => '2018-07-03 00:00:00'
    'name'          => 'Obdrženy údaje k zásilce.'
    'name_internal' => 'Zásilka zatím nebyla předána dopravci.'    
    'status_id'     => -1.0
    'type'          => 'event'
  ]
  ...
]
*/
```

### **TRACKSTATUS**

Use the **trackPackageLastStatus** method to get last package status.

Client normalize response format to match new [**TRACK V3**](#track) response.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$status = $client->trackPackageLastStatus(Shipper::CP, 'NP1504102246M');

/*
var_dump($status);
[
  'date'          => null,
  'name'          => 'Obdrženy údaje k zásilce.'
  'name_internal' => 'Obdrženy údaje k zásilce.'
  'status_id'     => -1.0
  'type'          => 'event'
]
*/
```


### **OVERVIEW**

To view added packages (with no ordered shipment) for given shipper use **getOverview** method. 

It has the same response data format as [**ADD**](#add) request.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$orderedPackages = $client->getOverview(Shipper::CP);

/*
var_dump($orderedPackages);
[
  0 => [
    'eshop_id'   => '567A2889'
    'carrier_id' => 'NP1504102246M'
    'package_id' => '42719'
    'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.'
  ]
  1 => [
    'eshop_id'   => '567A2890'
    'carrier_id' => 'NP1504102247M'
    'package_id' => '42720'
    'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.'
  ]
  ...
]
*/
```


### **LABELS**

Method **getLabels** return link to labels PDF file for given packages.

The client normalizes the response by returning only **labels_url** string.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$labelsUrl = $client->getLabels(Shipper::CP, [42717, 42719]);

/*
var_dump($labelsUrl);
'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbawNAdcMBAfAoM.'
*/
```


### **PACKAGE**

To get full info about added package use **getPackageInfo()** method.

Response contains all options from request and all response data from [**ADD**](#add) request for each package.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$package = $client->getPackageInfo(Shipper::CP, 42717);

/*
var_dump($package);
[
  'service_type' => 'NP'
  'vs'           => ''
  'cod_price'    => 0.00
  'rec_firm'     => ''
  'rec_zip'      => '17000'
  'rec_phone'    => '777555666'
  
  ...
  
  'eshop_id'     => '15431025445bf9e0509a87d'
  'carrier_id'   => 'NP1504102229M'
  'package_id'   => '42717'
  'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwZcMBAVAnw.'
]
*/
```


### **ORDER**

To order shipment for packages use **orderShipment** method.

The client normalizes the response by removing the status code (drop **status** attribute).

```php
use Inspirum\Balikobot\Definitions\Shipper;

$orderedShipment = $client->orderShipment(Shipper::CP, [42717, 42718]);

/*
var_dump($orderedShipment);
[
  'order_id'     => 2757
  'file_url'     => 'https://csv.balikobot.cz/cp/eNorMTIwt9A1MjczAlwwDZECRA..'
  'handover_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbawtARcMBAhAoU.'
  'labels_url'   => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbawtFwwXDAQIAKE'
]
*/
```


### **ORDERVIEW**

To get ordered shipment data by order ID use **getOrder** method. 
It has shipper code and order ID (**order_id** attribute from [**ORDER**](#order) request) as arguments. 

The client normalizes the response by removing the status code (drop **status** attribute).

```php
use Inspirum\Balikobot\Definitions\Shipper;

$orderedShipment = $client->getOrder(Shipper::CP, 2757);

/*
var_dump($orderedShipment);
[
  'order_id'     => 2757
  'file_url'     => 'https://csv.balikobot.cz/cp/eNorMTIwt9A1MjczAlwwDZECRA..'
  'handover_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbawtARcMBAhAoU.'
  'labels_url'   => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbawtFwwXDAQIAKE'
  'package_ids'  => [
    0 => '42717'
    1 => '42718'
  ]
]
*/
```


### **ORDERPICKUP**

To order pickup for packages use **orderPickup** method.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$client->orderPickup(
  Shipper::CP,
  new DateTime('2018-12-01 14:00'),
  new DateTime('2018-12-01 18:00'),
  5.2,
  3
);
```


### **SERVICES**

Method **getServices** returns a list of services that can be used by the shipper.

The client normalizes the response by returning only **service_type** array.

```php
$services = $client->getServices('cp');

/*
var_dump($services);
[
  'DR' => 'DR - Balík Do ruky'
  'RR' => 'RR - Doporučená zásilka'
  'SR' => 'RR - Doporučená zásilka - standard'
  'NP' => 'NP - Balík Na poštu'
  'VL' => 'VL - Cenné psaní'
  ...
]
*/
```


### **MANIPULATIONUNITS**

Method **getManipulationUnits** returns a list of possible manipulation units for pallet transport.

The client normalizes the response by returning unit code and value from as associative array `[id => value]` (with optional **fullData** parameter)

This units are used as **mu_type** option in [**ADD**](#add) request.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$units = $client->getManipulationUnits(Shipper::TOPTRANS, fullData: false);

/*
var_dump($units);
[
  'KAR'    => 'KARTON'
  'KUS'    => 'KUS'
  'PALETA' => 'PALETA'
  'EPAL'   => 'EPAL'
  'SKLPAL' => 'SKLPAL'
  'OBALKA' => 'OBALKA'
  'PYTEL'  => 'PYTEL'
  ...
]
*/
```

```php
use Inspirum\Balikobot\Definitions\Shipper;

$units = $client->getManipulationUnits(Shipper::TOPTRANS, fullData: true);

/*
var_dump($units);
[
  'KAR' => [
    'code' => 'KAR'
    'name' => 'KARTON
  ]
  'KUS'    => [
    'code' => 'KUS'
    'name' => 'KUS
  ]
  ...
]
*/
```


### **ACTIVATEDMANIPULATIONUNITS**

Method **getActivatedManipulationUnits** returns a list of activated manipulation units for pallet transport.

The client normalizes the response by returning unit code and value from as associative array `[id => value]` (with optional **fullData** parameter).

This units are used as **mu_type** option in [**ADD**](#add) request.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$units = $client->getActivatedManipulationUnits(Shipper::TOPTRANS);

/*
var_dump($units);
[
  'KAR'    => 'KARTON'
  'PALETA' => 'PALETA'
  'SKLPAL' => 'SKLPAL'
  'PYTEL'  => 'PYTEL'
  ...
]
*/
```

```php
use Inspirum\Balikobot\Definitions\Shipper;

$units = $client->getActivatedManipulationUnits(Shipper::TOPTRANS, fullData: true);

/*
var_dump($units);
[
  'KAR' => [
    'code' => 'KAR'
    'name' => 'KARTON
  ]
  'PALETA'    => [
    'code' => 'PALETA'
    'name' => 'PALETA
  ]
  ...
]
*/
```


### **BRANCHES**

Method **getBranches** returns available branches for given shipper and its service type.

The client normalizes the response by returning only **branches** array.

```php
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$branches = $client->getBranches(Shipper::CP, ServiceType::CP_NP);

/*
var_dump($branches);
[
  0 => [
    'id'      => '10000'
    'name'    => 'Praha 10'
    'city'    => 'Praha'
    'street'  => 'Černokostelecká 2020/20'
    'zip'     => '10000'
    'country' => 'CZ'
    'type'    => 'branch'
  ]
  1 => [
    ...
  ]
  ...
]
*/
```

Method **getBranches** with optional fourth parameter `$country` returns available branches filtered by given country code.

You can use the `Shipper::hasBranchCountryFilterSupport()` method to test whether the shipper supports filtering branches by country.


```php
use Inspirum\Balikobot\Definitions\Country;use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$branches = $client->getBranches(Shipper::PPL, ServiceType::PPL_PARCEL_IMPORT, fullBranchesRequest: false, Country::GERMANY);

/*
var_dump($branches);
[
  0 => [
    'id'      => 'KM48755130'
    'name'    => 'Elektro Store Mainz'
    'city'    => 'Mainz'
    'street'  => 'Portlandstr. 35'
    'zip'     => '55130'
    'country' => 'DE'
    'type'    => 'branch'
  ]
  1 => [
    ...
  ]
  ...
]
*/
```


### **FULLBRANCHES**

Method **getBranches** with optional third parameter `$fullBranchRequest=true` returns available branches with more information for given shipper and its service type if possible.

You can use the `Shipper::hasFullBranchesSupport()` method to test whether the shipper supports a `FULLBRANCHES` request.

The client normalizes the response by returning only **branches** array.

```php
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$fullBranchRequest = Shipper::hasFullBranchesSupport(Shipper::ZASILKOVNA, service: null);

/*
var_dump($fullBranchRequest);
true
*/

$fullBranchRequest = Shipper::hasFullBranchesSupport(Shipper::DPD, ServiceType::DPD_PICKUP);

/*
var_dump($fullBranchRequest);
false
*/
```

```php
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$branches = $client->getBranches(Shipper::ZASILKOVNA, service: null, fullBranchesRequest: true);

/*
var_dump($branches);
[
  0 => [
    'id'          => '12'
    'name'        => 'České Budějovice, Rudolfovská 1 Tvořilka'
    'city'        => 'České Budějovice'
    'street'      => 'Rudolfovská 1'
    'zip'         => '37001'
    'district'    => 'okres České Budějovice'
    'region'      => 'Jihočeský kraj'
    'country'     => 'CZ'
    'currency'    => 'CZK'
    'type'        => 'branch'
    'photo_small' => 'https://www.zasilkovna.cz/images/branch/thumb/kv.jpg'
    'photo_big'   => 'https://www.zasilkovna.cz/images/branch/normal/kv.jpg'
    'url'         => 'https://www.zasilkovna.cz/pobocky/ceske-budejovice-otakarova-rudolfovska'
    'latitude'    => 48.97585
    'longitude'   => 14.47978
    ...
  ]
  1 => [
    ...
  ]
  ...
]
*/
```


### **BRANCHLOCATOR**

Method **getBranchesForLocation** returns available branches for given shipper in given location (city, postcode, street).

The client normalizes the response by returning only **branches** array.

```php
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\Shipper;

$branches = $client->getBranchesForLocation(Shipper::UPS, Country::CZECH_REPUBLIC, 'Praha');

/*
var_dump($branches);
[
  0 => [
    'id'          => 'U25943513'
    'name'        => 'Večerka'
    'city'        => 'Praha'
    'street'      => 'Mánesova 64'
    'zip'         => '12000'
    'region'      => ''
    'country'     => 'CZ'
    'type'        => 'branch'
    'photo_large' => 'https://www.ups.com/rms/image?id=BB11B7EB-3225-4994-9FD7-B2BE72D8D2E7'
    'latitude'    => 50.07759857
    'longitude'   => 14.44414043
    ...
  ]
  1 => [
    ...
  ]
  ...
]
*/
```


### **COD4SERVICES**

Method **getCodCountries** returns available countries where service with cash-on-delivery payment type for service types from given shipper.

The client normalizes the response by returning only countries for service type as associative array `[service_type => cod_countries]`.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$countries = $client->getCodCountries(Shipper::PPL);

/*
var_dump($countries);
[
  '2' => [
    'SK' => [
      'max_price' => 3000
      'currency'  => 'EUR'
    ]
    'PL' => [
      'max_price' => 6400
      'currency'  => 'PLN'
    ]
  ]
  '3' => [
    'CZ' => [
      'max_price' => 200000
      'currency'  => 'CZK'
    ]
  ]
  ...
]
*/
```


### **COUNTRIES4SERVICE**

Method **getCountries** returns available countries for service types from given shipper.

The client normalizes the response by returning only countries for service type as associative array `[service_type => countries]`.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$countries = $client->getCountries(Shipper::PBH);

/*
var_dump($countries);
[
  '1' => [
    0 => 'SE'
    1 => 'FI'
    2 => 'PT'
    3 => 'DK'
    4 => 'BG'
    5 => 'LT'
    6 => 'LV'
    ...
  ]
  ...
  
  '4' => [
    0 => 'SK'
  ]
  '5' => [
    0 => 'HU'
    1 => 'DE'
  ]
  ...
]
*/
```


### **ZIPCODES**

Method **getPostCodes** returns available zipcodes for given shipper, service types and country.

The client normalizes the response by returning same data format for original **zip**, **zip_range** or **city** response formats.
Use **postcode** instead of **zip** or **zip_start**, **postcode_end** instead of **zipcode_end**, the other attributes remain the same (with `null` value if missing in API response).

```php
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$postcodes = $client->getPostCodes(Shipper::PPL, ServiceType::PPL_BUSINESS);

/*
var_dump($postcodes);
[
  0 => [
    'postcode'     => '10000'
    'postcode_end' => null
    'city'         => null
    'county'       => 'CZ'
    '1B'           => false
  ]
  1 => [
    'postcode'     => '10003'
    'postcode_end' => null
    'city'         => null
    'county'       => 'CZ'
    '1B'           => false
  ]
  ...
]
*/
```

```php
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$postcodes = $client->getPostCodes(Shipper::GEIS, ServiceType::GEIS_CARGO_BUSINESS_NATIONAL);

/*
var_dump($postcodes);
[
  0 => [
    'postcode'     => '50755'
    'postcode_end' => '50773'
    'city'         => null
    'county'       => 'CZ'
    '1B'           => false
  ]
  1 => [
    'postcode'     => '50781'
    'postcode_end' => '50792
    'city'         => null
    'county'       => 'CZ'
    '1B'           => false
  ]
  ...
]
*/
```

```php
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$postcodes = $client->getPostCodes(Shipper::DHL, ServiceType::DHL_WORLDWIDE, Country::ANDORRA);

/*
var_dump($postcodes);
[
  0 => [
    'postcode'     => '25999'
    'postcode_end' => '25999'
    'city'         => 'AIXIRIVALL'
    'county'       => 'AD'
  ]
  ...
]
*/
```


### **CHECK**

The **checkPackages** method is used to validate data for [**ADD**](#add) request.

This method has no return value if give data is valid, and it throws exception on error same as **addPackage** request.


```php
use Inspirum\Balikobot\Definitions\Option;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$client->checkPackages(Shipper::CP, [
  [
    Option::SERVICE_TYPE  => ServiceType::CP_NP,
    Option::REAL_ORDER_ID => '180001',
    Option::REC_NAME      => 'Josef Novák',
    Option::PRICE         => 1500,
    ...
  ],
]);
```

```php
use Inspirum\Balikobot\Definitions\Option;
use Inspirum\Balikobot\Definitions\Shipper;

$client->checkPackages(Shipper::CP, [
  [
    // Option::SERVICE_TYPE  => ServiceType::CP_NP,
    Option::REAL_ORDER_ID => '180001',
    Option::REC_NAME      => 'Josef Novák',
    Option::PRICE         => 1500,
    ...
  ]
]);

/*
PHP Fatal error: Uncaught Inspirum\Balikobot\Exceptions\BadRequestException: 
'Operace neproběhla v pořádku, zkontrolujte konkrétní data'

'statusCode' => 400
'errors => [
  0 => [ 
    'service_type' => 'Nedorazilo ID vybrané služby přepravce.'
  ]
]
*/
```


### **ADRUNITS**

Method **getAdrUnits** returns a list of possible manipulation units for pallet transport.

The client normalizes the response by returning unit ID and value from as associative array `[id => value]` (with optional **fullData** parameter).

This units are used as **adr_un** option in [**ADD**](#add) request.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$units = $client->getAdrUnits(Shipper::TOPTRANS);

/*
var_dump($units);
[
  '432'  => 'PŘEDMĚTY PYROTECHNICKÉ pro technické účely'
  '1001' => 'ACETYLÉN, ROZPUŠTĚNÝ'
  '1002' => 'VZDUCH, STLAČENÝ'
  '1003' => 'VZDUCH, HLUBOCE ZCHLAZENÝ, KAPALNÝ'
  '1005' => 'AMONIAK (ČPAVEK), BEZVODÝ'
  '1006' => 'ARGON, STLAČENÝ'
  '1008' => 'FLUORID BORITÝ'
  '1009' => 'BROMTRIFLUORMETHAN (PLYN JAKO CHLADICÍ PROSTŘEDEK R 13B1)'
  ...
]
*/
```

```php
use Inspirum\Balikobot\Definitions\Shipper;

$units = $client->getAdrUnits(Shipper::TOPTRANS, fullData: true);

/*
var_dump($units);
[
  '432'  => [
    'id'   => 299
    'code' => '432'
    'name' => 'PŘEDMĚTY PYROTECHNICKÉ pro technické účely'
  ]
  '1001' => [
    'id'   => 377
    'code' => '1001'
    'name' => 'ACETYLÉN, ROZPUŠTĚNÝ'
  ]
  ...
]
*/
```

### **ACTIVATEDSERVICES**

Method **getActivatedServices** returns a list of activated services that can be used by the shipper.

The client normalizes the response by removing the status code (drop **status** attribute).

```php
use Inspirum\Balikobot\Definitions\Shipper;

$services = $client->getServices(Shipper::CP);

/*
var_dump($services);
[
  'active_parcel' => true
  'active_cargo'  => false
  'service_types' => [
    'DR' => 'DR - Balík Do ruky'
    'RR' => 'RR - Doporučená zásilka'
    'SR' => 'RR - Doporučená zásilka - standard'
    'NP' => 'NP - Balík Na poštu'
    'VL' => 'VL - Cenné psaní'
    ...
  ]
]
*/
```


### **B2A**

Method **orderB2AShipment** order shipments from place **B** (typically supplier / previous consignee) to place **A** (shipping point)

The client normalizes the response by removing the status code (drop **status** attribute).


```php
use Inspirum\Balikobot\Definitions\Option;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$orderedPackages = $client->orderB2AShipment(Shipper::PPL, [
  [
    Option::SERVICE_TYPE     => ServiceType::PPL_PARCEL_BUSSINESS_CZ,
    Option::EID              => '1900710001',
    Option::PICKUP_DATE      => '2019-11-11',
    Option::PICKUP_TIME_FROM => '13:30',
    Option::PICKUP_TIME_TO   => '15:30',
    // ...
  ],
  // ...
]);

/*
var_dump($orderedPackages);
[
  0 => [
    'package_id'     => '24'
    'status_message' => 'OK, přeprava byla objednána'
    'status'         => 200
  ]
]
*/
```


### **POD**

Method **getProofOfDeliveries** returns PDF links with signed consignment delivery document by the recipient.

The client normalizes the response by returning only **file_url** attribute as plain array.


```php
use Inspirum\Balikobot\Definitions\Shipper;

$fileUrls = $client->getProofOfDeliveries(Shipper::TNT, ['GE502878792CZ', 'GE502878794CZ']);

/*
var_dump($fileUrls);
[
  0 => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs'
  1 => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwRE'
]
*/
```


### **TRANSPORTCOSTS**

Method **getTransportCosts** obtain the price of carriage at consignment level.

The client normalizes the response by returning only transport cost data (drop **status** attribute).


```php
use Inspirum\Balikobot\Definitions\Option;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$transportCosts = $client->getTransportCosts(Shipper::TOPTRANS, [
  [
    Option::SERVICE_TYPE  => ServiceType::TOPTRANS_STANDARD,
    Option::EID           => '12345678',
    Option::REAL_ORDER_ID => '180001',
    Option::ORDER_NUMBER  => 1,
    Option::REC_NAME      => 'Josef Novák',
    Option::MU_TYPE       => 'KUS',
    Option::WEIGHT        => 20.1,
    // ...
  ],
  // ...
]);

/*
var_dump($transportCosts);
[
  0 => [
    'eid'             => '12345678'
    'costs_total'     => 336.0
    'currency'        => 'CZK'
    'costs_breakdown' => [
      0 => [
        'name' => 'Base price'
        'cost' => 336.0
      ]
    ]
    'status'          => '200'
  ]
],
*/
```


### **GETCOUNTRIESDATA**

Method **getCountriesData** obtain information on individual countries of the world.

The client normalizes the response by returning only countries data (drop **status** attribute).


```php
$countries = $client->getCountriesData();

/*
var_dump($countries);
[
  [
    'name_en'      => 'Andorra'
    'name_cz'      => 'Andorra'
    'iso_code'     => 'AD'
    'phone_prefix' => '+376'
    'currency'     => 'EUR'
    'continent'    => 'Europe'
  ]
  [
    'name_en'      => 'United Arab Emirates'
    'name_cz'      => 'Spojené arabské emiráty'
    'iso_code'     => 'AE'
    'phone_prefix' => '+971'
    'currency'     => 'AED'
    'continent'    => 'Asia'
  ]
  ...
]
*/
```


### **CHANGELOG**

Method **getChangelog** obtain news in the Balikobot API

The client normalizes the response by returning only changelog data (drop **status** attribute).


```php
$changelog = $client->getChangelog();

/*
var_dump($changelog);
[
  'api_v1_documentation_cz' => 'https://balikobot.docs.apiary.io/'
  'api_v2_documentation_cz' => 'https://balikobotv2.docs.apiary.io/'
  'api_v1_documentation_en' => 'https://balikoboteng.docs.apiary.io/'
  'api_v2_documentation_en' => 'https://balikobotv2eng.docs.apiary.io/'
  'version'                 => '1.900'
  'date'                    => '2020-12-18'
  'versions'                => [
    0 => [
      'version' => '1.900'
      'date'    => '2020-12-18'
      'changes' => [
        0 => [
          'name'        => 'ADD Zásilkovna'
          'description' => '- delivery_costs a delivery_costs_eur - přidání GB'
        ]
        1 => [
          'name'        => 'ADD PbH',
          'description' => '- content data - přidání GB'
        ]
      ]
    ],
    1 => [
      'version' => '1.899'
      'date'    => '2020-12-07'
      'changes' => [
        0 => [
          'name'        => 'ADD Gebrüder Weiss Česká republika'
          'description' => '- nový atribut rec_floor_number - číslo patra'
        ]
      ]
    ]
    ...
  ]
]
*/
```

### **ADDATTRIBUTES**

Method **getAddAttributes** obtains a list of available input attributes for the ADD method.

The client normalizes the response by returning service option code and value from as associative array `[name => attribute]`.

These attributes are used in [**ADD**](#add) request.


```php
use Inspirum\Balikobot\Definitions\Shipper;

$attributes = $client->getAddAttributes(Shipper::CP);

/*
var_dump($attributes);
[
  'eid' => [
    'name'       => 'eid'
    'data_type'  => 'string'
    'max_length' => 40
  ]
  'services' => [
    'name'       => 'services'
    'data_type'  => 'plus_separated_values'
    'max_length' => null
  ]
  'vs' => [
    'name'       => 'vs'
    'data_type'  => 'int'
    'max_length' => 10
  ]
  ...
]
*/
```


### **ADDSERVICEOPTIONS**

Method **getAddServiceOptions** obtains a list of additional services by individual transport services.

The client normalizes the response by returning service option code and value from as associative array `[id => value]` (with optional **fullData** parameter).

These services are used as **services** option in [**ADD**](#add) request.


```php
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$options = $client->getAddServiceOptions(Shipper::CP, ServiceType::CP_CE);

/*
var_dump($options);
[
  '10' => 'Neskladně'
  '44' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)'
  ...
]
*/
```


## All available methods

```php
interface Client {

  function addPackages(string $shipper, array $packages, &$labelsUrl = null): array;
    
  function dropPackage(string $shipper, int $packageId): void;
    
  function dropPackages(string $shipper, array $packageIds): void;
    
  function trackPackage(string $shipper, string $carrierId): array;
    
  function trackPackages(string $shipper, array $carrierIds): array;
    
  function trackPackageLastStatus(string $shipper, string $carrierId): array;
    
  function trackPackagesLastStatus(string $shipper, array $carrierIds): array;
    
  function getOverview(string $shipper): array;
    
  function getLabels(string $shipper, array $packageIds): string;
    
  function getPackageInfo(string $shipper, int $packageId): array;
    
  function orderShipment(string $shipper, array $packageIds): array;
    
  function getOrder(string $shipper, int $orderId): array;
    
  function orderPickup(string $shipper, DateTime $dateFrom, DateTime $dateTo, float $weight, int $packageCount, string $message = null): void;
    
  function getServices(string $shipper): array;
    
  function getManipulationUnits(string $shipper, bool $fullData = false): array;
    
  function getActivatedManipulationUnits(string $shipper, bool $fullData = false): array;
    
  function getBranches( string $shipper, ?string $service, bool $fullBranchRequest = false, string $country = null): array;
    
  function getBranchesForLocation(string $shipper, string $country, string $city, string $postcode = null, string $street = null, int $maxResults = null, float $radius = null, string $type = null): array;
    
  function getCodCountries(string $shipper): array;
    
  function getCountries(string $shipper): array;
    
  function getPostCodes(string $shipper, string $service, string $country = null): array;
    
  function checkPackages(string $shipper, array $packages): void;
    
  function getAdrUnits(string $shipper, bool $fullData = false): array;
    
  function getActivatedServices(string $shipper): array;
    
  function orderB2AShipment(string $shipper, array $packages): array;
    
  function getB2AServices(string $shipper): array;
    
  function getProofOfDelivery(string $shipper, string $carrierId): string;
    
  function getProofOfDeliveries(string $shipper, array $carrierIds): array;
    
  function getTransportCosts(string $shipper, array $packages): array;
    
  function getCountriesData(): array;
  
  function getChangelog(): array;
  
  function getAddAttributes(string $shipper): array;
  
  function getAddServiceOptions(string $shipper, string $service = null, bool $fullData = false): array;
}
```


***


## More usage


### [**Definitons**](./definitions.md)

The module contains several helper classes that contain most of the constants needed to work with the Balikobot API.


### [**Balikobot**](./balikobot.md)

Extension over Client that uses custom DTO classes as an input and output for its methods.
