# Balikobot API

**Created as part of [inspishop][link-inspishop] e-commerce platform by [inspirum][link-inspirum] team.**

[![Latest Stable Version][ico-packagist-stable]][link-packagist-stable]
[![Build Status][ico-workflow]][link-workflow]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![PHPStan][ico-phpstan]][link-phpstan]
[![Total Downloads][ico-packagist-download]][link-packagist-download]
[![Software License][ico-license]][link-licence]

Offers implementation of Balikobot API v2 described in the [documentation](#version)

- Support for all API [requests](./docs/client.md#requests)
- Simple add/track/drop package [methods](./docs/balikobot.md#packages)
- All package options are accessible via setter and getter methods
- The entire code is covered by unit and integration tests
- Customizable [**Requester**](./src/Contracts/RequesterInterface.php) for easy functionality expandability (caching, etc.)


## Usage example

*All the code snippets shown here are modified for clarity, so they may not be executable.*

```php
// get credentials
$apiUser = getenv('BALIKOBOT_API_USER');
$apiKey  = getenv('BALIKOBOT_API_KEY');

// init balikobot class
$requester = new Requester($apiUser, $apiKey);
$balikobot = new Balikobot($requester);
$data      = [];

// create new package collection for specific shipper
$packages = new PackageCollection(Shipper::CP);

// create new package
$package = new Package();
$package->setServiceType(ServiceType::CP_NP);
$package->setRecName('Josef Novák');
$package->setRecZip('11000');
$package->setRecCountry(Country::CZECH_REPUBLIC);
$package->setRecPhone('776555888');
$package->setCodPrice(1399.00);
$package->setCodCurrency(Currency::CZK);

// add package to collection
$packages->add($package);

// upload packages to balikobot
$orderedPackages = $balikobot->addPackages($packages);

// save package IDs
$data['packages'] = $orderedPackages->getPackageIds();

// save track URL for each package
foreach($orderedPackages as $orderedPackage) {
  $data['trackUrl'][] = $orderedPackage->getTrackUrl();
}

// order shipment for packages
$orderedShipment = $balikobot->orderShipment($orderedPackages);

// save order ID and labels URL
$data['orderId']     = $orderedShipment->getOrderId();
$data['labelsUrl']   = $orderedShipment->getLabelsUrl();
$data['handoverUrl'] = $orderedShipment->getHandoverUrl();

/*
var_dump($data);
[
  'packages'    => [
    0 => 42719
    1 => 42720
  ]
  'trackUrl'    => [
    0 => 'https://www.postaonline.cz/trackandtrace/-/zasilka/cislo?parcelNumbers=DR00112233M'
    1 => 'https://www.postaonline.cz/trackandtrace/-/zasilka/cislo?parcelNumbers=DR00112234M' 
  ]
  'orderId'     => 2757
  'labelsUrl'   => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwM76cMBAXAn4.'
  'handoverUrl' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbawtARcMBAhAoU.'
]
*/
```

See more available methods documentation in [Usage](#usage) section.


## System requirements

* [PHP 7.1+](http://php.net/releases/7_1_0.php)
* [ext-curl](http://php.net/curl)
* [ext-json](http://php.net/json)


## Installation

Run composer require command:
```bash
$ composer require inspirum/balikobot
```
or add a requirement to your `composer.json`:
```json
"inspirum/balikobot": "^5.0"
```


## Version

Support all options for Balikobot API [v2][link-api-v2-upgrade] described in the official [documentation][link-api-v2] until **v1.924** *(2021-06-18)*.

If you want to use older API [v1][link-api], please use `^4.0` version:

More details are available in [changelog][link-changelog].


## Usage

### [**Definitons**](./docs/definitions.md)

The module contains several helper classes that contain most of the constants needed to work with the Balikobot API.

### [**Client**](./docs/client.md)

Support all options for Balikobot API described in given documentation.

### [**Balikobot**](./docs/balikobot.md)

Extension over Client that uses custom DTO classes as an input and output for its methods.


## Testing

To run unit tests, run:

```bash
$ composer test:test
```

You can also run only Unit or Integration test suites, run:

```bash
$ composer test:unit
$ composer test:integration
```

To show coverage, run:

```bash
$ composer test:coverage
```

For testing purposes, you can use these credentials:

- **API username:** balikobot_test2cztest
- **API key:** #lS1tBVo


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
[ico-workflow]:             https://img.shields.io/github/workflow/status/inspirum/balikobot-php/Test/master?style=flat-square
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
[link-inspishop]:           https://www.inspishop.cz/
[link-inspirum]:            https://www.inspirum.cz/
[link-packagist-stable]:    https://packagist.org/packages/inspirum/balikobot
[link-packagist-download]:  https://packagist.org/packages/inspirum/balikobot
[link-phpstan]:             https://github.com/phpstan/phpstan
