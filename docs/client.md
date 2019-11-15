# Client

Support all options for Balikobot API described in given [documentation version](../README.md#version).

Class [**Inspirum\Balikobot\Services\Client**](../src/Services/Client.php) is wrapper for all available requests in Balikobot API. Every method is documented in the next [section](#requests).

Client class has two required arguments – API user and API key. 
These credentials can be found in the Balikobot administration (section *"Profil expedičního místa"*).

```php
use Inspirum\Balikobot\Services\Client;

$user = getenv('BALIKOBOT_API_USER');
$key  = getenv('BALIKOBOT_API_KEY');

$client = new Client($user, $key);
```


## Exceptions

The client handles the API responses and throws an exception when an error occurs. 
All thrown exceptions implement [**Inspirum\Balikobot\Contracts\ExceptionInterface**](../src/Contracts/ExceptionInterface.php) interface.
Thrown exception include error message, API response and any validation messages (even if **return_full_errors** option is not set).

```php
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
    Options::SERVICE_TYPE  => ServiceType::CP_NP,
    Options::ORDER_ID      => '180001',
    Options::ORDER_NUMBER  => 1,
    Options::CUSTOMER_NAME => 'Josef Novák',
    Options::PRICE         => 1500,
    // ...
  ],
  [
    Options::SERVICE_TYPE  => ServiceType::CP_NP,
    Options::ORDER_ID      => '180001',
    Options::ORDER_NUMBER  => 2,
    Options::CUSTOMER_NAME => 'Josef Novák',
    Options::PRICE         => 2000,
    // ...
  ],
  // ...
]);

/*
var_dump($orderedPackages);
[
  0 => [
    'carrier_id' => 'NP1504102246M'
    'package_id' => 42719
    'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.'
    'status'     => '200'
  ]
  1 => [
    'carrier_id' => 'NP1504102247M'
    'package_id' => 42720
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

This method internally uses new **TRACK V2** request with better response data format. 

Older version (**TRACK V1**) is not longer available via this client.

```php
use Inspirum\Balikobot\Definitions\Shipper;

$statuses = $client->trackPackage(Shipper::CP, 'NP1504102246M');

/*
var_dump($statuses);
[
  0 => [
    'date'      => '2018-07-02 00:00:00'
    'name'      => 'Dodání zásilky. 10003 Depo Praha 701'
    'status_id' => 2
  ]
  1 => [
    'date'      => '2018-07-02 00:00:00'
    'name'      => 'Doručování zásilky. 10003 Depo Praha 701'
    'status_id' => 1
  ]
  2 => [
    'date'      => '2018-07-02 00:00:00'
    'name'      => 'Příprava zásilky k doručení. 10003 Depo Praha 701'
    'status_id' => 1
  ]
  ...
]
*/
```

### **TRACKSTATUS**

Use the **trackPackageLastStatus** method to get last package status.

Client normalize response format to match new [**TRACK V2**](#track) response.

```php
$status = $client->trackPackageLastStatus(Shipper::CP, 'NP1504102246M');

/*
var_dump($status);
[
  'date'      => '2018-07-02 00:00:00'
  'name'      => 'Zásilka zatím nebyla předána přepravci.'
  'status_id' => -1
]
*/
```


### **OVERVIEW**

To view added packages (with no ordered shipment) for given shipper use **getOverview** method. 

It has the same response data format as [**ADD**](#add) request.

```php
$orderedPackages = $client->getOverview(Shipper::CP);

/*
var_dump($orderedPackages);
[
  0 => [
    'eshop_id'   => '567A2889'
    'carrier_id' => 'NP1504102246M'
    'package_id' => 42719
    'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.'
  ]
  1 => [
    'eshop_id'   => '567A2890'
    'carrier_id' => 'NP1504102247M'
    'package_id' => 42720
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
  'package_id'   => 42717
  'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwZcMBAVAnw.'
]
*/
```


### **ORDER**

To order shipment for packages use **orderShipment** method.

The client normalizes the response by removing the status code (drop **status** attribute).

```php
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
$orderedShipment = $client->getOrder(Shipper::CP, 2757);

/*
var_dump($orderedShipment);
[
  'order_id'     => 2757
  'file_url'     => 'https://csv.balikobot.cz/cp/eNorMTIwt9A1MjczAlwwDZECRA..'
  'handover_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbawtARcMBAhAoU.'
  'labels_url'   => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbawtFwwXDAQIAKE'
  'package_ids'  => [
    0 => 42717
    1 => 42718
  ]
]
*/
```


### **ORDERPICKUP**

To order pickup for packages use **orderPickup** method.

```php
$orderedPickup = $client->orderPickup(
  Shipper::CP,
  new \DateTime('2018-12-01 14:00'),
  new \DateTime('2018-12-01 18:00'),
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

The client normalizes the response by returning unit ID and value from as associative array `[id => value]`.

This units are used as **mu_type** option in [**ADD**](#add) request.

```php
$units = $client->getManipulationUnits(Shipper::TOP_TRANS);

/*
var_dump($units);
[
  'KARTON' => 'KARTON'
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


### **BRANCHES**

Method **getBranches** returns available branches for given shipper and its service type.

The client normalizes the response by returning only **branches** array.

```php
$branches = $client->getBranches(Shipper::CP, ServiceType::CP_NP);

/*
var_dump($shippers);
[
  0 => [
    'name'    => 'Kojetice u Prahy'
    'city'    => 'Kojetice'
    'street'  => 'Lipová 75'
    'zip'     => '25072'
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


### **FULLBRANCHES**

Method **getBranches** returns available branches for given shipper and its service type.

The client normalizes the response by returning only **branches** array.

```php
$branches = $client->getBranches(Shipper::ZASILKOVNA, null, true);

/*
var_dump($shippers);
[
  0 => [
    'id'          => '2859'
    'name'        => 'OMURTAG,ZAVODSKA OMURTAG'
    'city'        => 'OMURTAG'
    'street'      => 'ul. ZAVODSKA 1'
    'zip'         => '7900'
    'district'    => ''
    'region'      => 'България'
    'country'     => 'BG'
    'currency'    => 'BGN'
    'type'        => 'branch'
    'photo_small' => 'https://www.zasilkovna.cz/images/branch/thumb/stub.jpg'
    'photo_big'   => 'https://www.zasilkovna.cz/images/branch/normal/stub.jpg'
    'url'         => 'https://www.zasilkovna.cz/pobocky/omurtag-zavodska'
    'latitude'    => 43.11715
    'longitude'   => 26.42129
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
$branches = $client->getBranchesForLocation(Shipper::UPS, Country::CZECH_REPUBLIC, 'Praha');

/*
var_dump($shippers);
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
$countries = $client->getCodCountries(Shipper::PPL)

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
$postcodes = $client->getPostCodes(Shipper::PPL, ServiceType::PPL_BUSINESS);

/*
var_dump($postcodes);
[
  0 => [
    'postcode'     => '10000'
    'postcode_end' => NULL
    'city'         => NULL
    'county'       => 'CZ'
    '1B'           => false
  ]
  1 => [
    'postcode'     => '10003'
    'postcode_end' => NULL
    'city'         => NULL
    'county'       => 'CZ'
    '1B'           => false
  ]
  ...
]
*/
```

```php
$postcodes = $client->getPostCodes(Shipper::GEIS, ServiceType::GEIS_PARCEL_PRIVATE));

/*
var_dump($postcodes);
[
  0 => [
    'postcode'     => '50755'
    'postcode_end' => '50773'
    'city'         => NULL
    'county'       => 'CZ'
    '1B'           => false
  ]
  1 => [
    'postcode'     => '50781'
    'postcode_end' => '50792
    'city'         => NULL
    'county'       => 'CZ'
    '1B'           => false
  ]
  ...
]
*/
```

```php
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
$client->checkPackages(Shipper::CP, [
  [
    Options::SERVICE_TYPE  => ServiceType::CP_NP,
    Options::ORDER_ID      => '180001',
    Options::CUSTOMER_NAME => 'Josef Novák',
    Options::PRICE         => 1500,
    ...
  ],
]);
```

```php
$client->checkPackages(Shipper::CP, [
  [
    // Options::SERVICE_TYPE  => ServiceType::CP_NP,
    Options::ORDER_ID      => '180001',
    Options::CUSTOMER_NAME => 'Josef Novák',
    Options::PRICE         => 1500,
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

The client normalizes the response by returning unit ID and value from as associative array `[id => value]`.

This units are used as **adr_un** option in [**ADD**](#add) request.

```php
$units = $client->getAdrUnits(Shipper::TOP_TRANS, ServiceType::TOP_TRANS_STANDARD);

/*
var_dump($units);
[
  432  => 'PŘEDMĚTY PYROTECHNICKÉ pro technické účely'
  1001 => 'ACETYLÉN, ROZPUŠTĚNÝ'
  1002 => 'VZDUCH, STLAČENÝ'
  1003 => 'VZDUCH, HLUBOCE ZCHLAZENÝ, KAPALNÝ'
  1005 => 'AMONIAK (ČPAVEK), BEZVODÝ'
  1006 => 'ARGON, STLAČENÝ'
  1008 => 'FLUORID BORITÝ'
  1009 => 'BROMTRIFLUORMETHAN (PLYN JAKO CHLADICÍ PROSTŘEDEK R 13B1)'
  ...
]
*/
```


### **ACTIVATEDSERVICES**

Method **getActivatedServices** returns a list of activated services that can be used by the shipper.

The client normalizes the response by removing the status code (drop **status** attribute).

```php
$services = $client->getServices('cp');

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

Method **B2A** order shipments from place **B** (typically supplier / previous consignee) to place **A** (shipping point)

The client normalizes the response by removing the status code (drop **status** attribute).


```php
use Inspirum\Balikobot\Definitions\Option;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$orderedPackages = $client->orderB2AShipment(Shipper::PPL, [
  [
    Options::SERVICE_TYPE     => ServiceType::PPL_PARCEL_BUSSINESS_CZ,
    Options::EID              => '1900710001',
    Options::PICKUP_DATE      => '2019-11-11',
    Options::PICKUP_TIME_FROM => '13:30',
    Options::PICKUP_TIME_TO   => '15:30',
    // ...
  ],
  // ...
]);

/*
var_dump($orderedPackages);
[
  0 => [
    'package_id'     => 24
    'status_message' => 'OK, přeprava byla objednána-'
    'status'         => '200'
  ]
]
*/
```


### **POD**

Method **POD** returns PDF links with signed consignment delivery document by the recipient.

The client normalizes the response by returning only **file_url** attribute as plain array.


```php
use Inspirum\Balikobot\Definitions\Option;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

$fileUrls = $client->getProofOfDelivery(Shipper::TNT, ['GE502878792CZ', 'GE502878794CZ']);

/*
var_dump($fileUrls);
[
  '0' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
  '1' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwRE',
]
*/
```

***


## More usage


### [**Definitons**](./definitions.md)

The module contains several helper classes that contain most of the constants needed to work with the Balikobot API.


### [**Balikobot**](./balikobot.md)

Extension over Client that uses custom DTO classes as an input and output for its methods.
