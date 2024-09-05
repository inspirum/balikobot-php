# Balikobot API

[![Latest Stable Version][ico-packagist-stable]][link-packagist-stable]
[![Build Status][ico-workflow]][link-workflow]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![PHPStan][ico-phpstan]][link-phpstan]
[![Total Downloads][ico-packagist-download]][link-packagist-download]
[![Software License][ico-license]][link-licence]

Offers implementation of Balikobot API [v2][link-api-v2-upgrade] described in the official [documentation][link-api-v2] until **v2.004** *(2024-08-06)*.

> If you want to use older API [v1][link-api], please use [`^4.0`](https://github.com/inspirum/balikobot-php/tree/v4.5.0) version.

More details are available in [changelog][link-changelog].


## Usage example

See more available methods' documentation in [Usage](#usage) section.

> *All the code snippets shown here are modified for clarity, so they may not be executable.*

#### Create packages and order shipment

```php
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\Currency;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageData;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageDataCollection;
use Inspirum\Balikobot\Service\PackageService;

/** @var Inspirum\Balikobot\Service\PackageService $packageService */

// create new package collection for specific carrier
$packagesData = new DefaultPackageDataCollection(Carrier::CP);

// create new package
$packageData = new DefaultPackageData();
$packageData->setServiceType(Service::CP_NP);
$packageData->setRecName('Josef Novák');
$packageData->setRecZip('11000');
$packageData->setRecCountry(Country::CZECH_REPUBLIC);
$packageData->setRecPhone('776555888');
$packageData->setCodPrice(1399.00);
$packageData->setCodCurrency(Currency::CZK);

// add package to collection
$packagesData->add($packageData);

// upload packages to balikobot
$packages = $packageService->addPackages($packagesData);

// save package IDs
$data = [];
$data['packages'] = $packages->getPackageIds();

// save track URL for each package
foreach($packages as $package) {
  $data['trackUrl'][] = $package->getTrackUrl();
}

// order shipment for packages
$orderedShipment = $packageService->orderShipment($orderedPackages);

// save order ID and labels URL
$data['orderId'] = $orderedShipment->getOrderId();
$data['labelsUrl'] = $orderedShipment->getLabelsUrl();
$data['handoverUrl'] = $orderedShipment->getHandoverUrl();

/**
var_dump($data);
[
  'packages' => [
    0 => 42719
    1 => 42720
  ]
  'trackUrl' => [
    0 => 'https://www.postaonline.cz/trackandtrace/-/zasilka/cislo?parcelNumbers=DR00112233M'
    1 => 'https://www.postaonline.cz/trackandtrace/-/zasilka/cislo?parcelNumbers=DR00112234M' 
  ]
  'orderId' => 2757
  'labelsUrl' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwM76cMBAXAn4.'
  'handoverUrl' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbawtARcMBAhAoU.'
]
*/
```


#### Test packages data / delete packages

```php
use Inspirum\Balikobot\Exception\Exception;

/** @var Inspirum\Balikobot\Service\PackageService $packageService */

// check if packages data is valid
try {
    $packageService->checkPackages($packagesData);
} catch (Exception $exception) {
    return $exception->getErrors();
}

// drop packages if shipment is not ordered yet
$packageService->dropPackages($packages);
````


#### Track packages

```php
use Inspirum\Balikobot\Definitions\Status;

/** @var Inspirum\Balikobot\Service\TrackService $trackService */

// track last package status
$status = $trackService->trackPackageLastStatus($packages[0]);
/**
var_dump($status);
Inspirum\Balikobot\Model\Status\DefaultStatus {
  private $carrier => 'cp'
  private $carrierId => '1234'
  private $id => 2.2
  private $name => 'Zásilka byla doručena příjemci.'
  private $description => 'Dodání zásilky. (77072 - Depo Olomouc 72)'
  private $type => 'event'
  private $date => DateTimeImmutable { '2018-07-02 09:15:01.000000' }
}
*/
        
if (Status::isError($status->getId())) {
  // handle package delivery error
}

if ($status->getId() === Status::COD_PAID) {
  // CoD has been credited to the sender's account
}

if (Status::isDelivered($status->getId())) {
  // handle delivered package 
}
```

#### Import branches

```php
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;

/** @var Inspirum\Balikobot\Service\BranchService $branchService */

// get only branches for Zasilkovna in CZ/SK
$branches = $branchService->getBranchesForCarrierAndCountries(
  Carrier::ZASILKOVNA, 
  [Country::CZECH_REPUBLIC, Country::SLOVAKIA]
); 

foreach($branches as $branch) {
  /**
  var_dump($branch);
  Inspirum\Balikobot\Model\Branch\DefaultBranch {
    private $carrier => 'zasilkovna'
    private $service => null
    private $branchId => '10000'
    private $uid => 'VMCZ-zasilkovna-branch-10000'
    private $id => '10000'
    private $type => 'branch'
    private $name => 'Hradec Králové, Dukelská tř. 1713/7 (OC Atrium - Traficon) Tabák Traficon'
    private $city => 'Hradec Králové'
    private $street => 'Dukelská tř. 1713/7'
    private $zip => '50002'
    private $cityPart => null
    private $district => 'okres Hradec Králové'
    private $region => 'Královéhradecký kraj'
    private $country => 'CZ'
    ...
  }
  */
}
```


## System requirements

* [PHP 8.1+](http://php.net/releases/8_1_0.php)
* [ext-curl](http://php.net/curl)
* [ext-json](http://php.net/json)

If you are still using older PHP version, you can use this package in [`^5.0`](https://github.com/inspirum/balikobot-php/tree/5.x) version (for PHP 7.1+).

## Installation

Run composer require command:
```
composer require inspirum/balikobot
```
or add a requirement to your `composer.json`:
```json
"inspirum/balikobot": "^7.0"
```

### Setup service

Available framework integrations:

- [Symfony](https://github.com/inspirum/balikobot-php-symfony)
- [Laravel](https://github.com/inspirum/balikobot-php-laravel)
- [Nette](https://github.com/TomasHalasz/balikobot-nette)

But you can also use it without any framework implementation:

```php
use Inspirum\Balikobot\Client\DefaultClient;
use Inspirum\Balikobot\Client\DefaultCurlRequester;
use Inspirum\Balikobot\Client\Response\Validator;
use Inspirum\Balikobot\Model\Label\DefaultLabelFactory;
use Inspirum\Balikobot\Model\OrderedShipment\DefaultOrderedShipmentFactory;
use Inspirum\Balikobot\Model\Package\DefaultPackageFactory;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageDataFactory;
use Inspirum\Balikobot\Model\ProofOfDelivery\DefaultProofOfDeliveryFactory;
use Inspirum\Balikobot\Model\Status\DefaultStatusFactory;
use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCostFactory;
use Inspirum\Balikobot\Service\DefaultPackageService;
use Inspirum\Balikobot\Service\DefaultTrackService;

$apiUser = getenv('BALIKOBOT_API_USER');
$apiKey = getenv('BALIKOBOT_API_KEY');

$requester = new DefaultCurlRequester($apiUser, $apiKey, sslVerify: true);
$validator = new Validator();
$client = new DefaultClient($requester, $validator);

$packageService = new DefaultPackageService(
    $client,
    new DefaultPackageDataFactory(),
    new DefaultPackageFactory($validator),
    new DefaultOrderedShipmentFactory(),
    new DefaultLabelFactory(),
    new DefaultProofOfDeliveryFactory($validator),
    new DefaultTransportCostFactory($validator),
);

$trackService = new DefaultTrackService(
    $client,
    new DefaultStatusFactory($validator),
);

// ...
```

## Usage

The module contains several helper classes that contain most of the constants needed to work with the Balikobot API.

- [**Definitions**](./docs/definitions.md)
- [**Package service**](./docs/services.md#package-service)
- [**Track service**](./docs/services.md#track-service)
- [**Branch service**](./docs/services.md#branch-service)
- [**Setting service**](./docs/services.md#setting-service)
- [**Info service**](./docs/services.md#info-service)
- [**Providers**](./docs/services.md#providers)


## Testing

To run unit tests, run:

```
composer test:test
```

You can also run only Unit or Integration test suites, run:

```
composer test:unit
composer test:integration
```

To show coverage, run:

```
composer test:coverage
```

To run all test (phpcs, phpstan, phpunit, etc.), run:

```
composer test
```

For testing purposes, you can use these credentials:

- **API username:** `balikobot_test2cztest`
- **API key:** `#lS1tBVo`


## Contributing

Please see [CONTRIBUTING][link-contributing] and [CODE_OF_CONDUCT][link-code-of-conduct] for details.


## Security

If you discover any security related issues, please email tomas.novotny@inspirum.cz instead of using the issue tracker.


## Credits

- [Tomáš Novotný](https://github.com/tomas-novotny)
- [All Contributors][link-contributors]


## License

The MIT License (MIT). Please see [License File][link-licence] for more information.


[ico-license]:              https://img.shields.io/github/license/inspirum/balikobot-php.svg?style=flat-square&colorB=blue
[ico-workflow]:             https://img.shields.io/github/actions/workflow/status/inspirum/balikobot-php/master.yml?branch=master&style=flat-square
[ico-scrutinizer]:          https://img.shields.io/scrutinizer/coverage/g/inspirum/balikobot-php/master.svg?style=flat-square
[ico-code-quality]:         https://img.shields.io/scrutinizer/g/inspirum/balikobot-php.svg?style=flat-square
[ico-packagist-stable]:     https://img.shields.io/packagist/v/inspirum/balikobot.svg?style=flat-square&colorB=blue
[ico-packagist-download]:   https://img.shields.io/packagist/dt/inspirum/balikobot.svg?style=flat-square&colorB=blue
[ico-phpstan]:              https://img.shields.io/badge/style-level%208-brightgreen.svg?style=flat-square&label=phpstan

[link-author]:              https://github.com/inspirum
[link-contributors]:        https://github.com/inspirum/balikobot-php/contributors
[link-licence]:             ./LICENSE.md
[link-changelog]:           ./CHANGELOG.md
[link-contributing]:        ./docs/CONTRIBUTING.md
[link-code-of-conduct]:     ./docs/CODE_OF_CONDUCT.md
[link-workflow]:            https://github.com/inspirum/balikobot-php/actions
[link-scrutinizer]:         https://scrutinizer-ci.com/g/inspirum/balikobot-php/code-structure
[link-code-quality]:        https://scrutinizer-ci.com/g/inspirum/balikobot-php
[link-api]:                 https://balikobot.docs.apiary.io/#introduction/prehled-zmen
[link-api-v2]:              https://balikobotv2.docs.apiary.io/#introduction/prehled-zmen
[link-api-v2-upgrade]:      https://balikobotv2.docs.apiary.io/#introduction/rozdil-api-v2-vs-api-v1
[link-packagist-stable]:    https://packagist.org/packages/inspirum/balikobot
[link-packagist-download]:  https://packagist.org/packages/inspirum/balikobot/stats
[link-phpstan]:             https://github.com/phpstan/phpstan
