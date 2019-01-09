# Balikobot API

**Created as part of [inspishop][link-inspishop] e-commerce platform by [inspirum][link-inspirum] team.**

[![Latest Stable Version][ico-packagist-stable]][link-packagist-stable]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![PHPStan][ico-phpstan]][link-phpstan]
[![Total Downloads][ico-packagist-download]][link-packagist-download]
[![Software License][ico-license]][link-licence]

Offers implementation of Balikobot API described in the [documentation](#version)

- Support for all API [requests](./src/Services/Client.php)
- Simple add/track/drop package [methods](./src/Services/Balikobot.php)
- All package options are accessible via setter/getter methods
- The entire code is covered by unit tests
- Customizable [**Requester**](./src/Contracts/RequesterInterface.php) for easy functionality expandability (caching, etc.)


## Usage example

*All the code snippets shown here are modified for clarity, so they may not be executable.*

```php
// init balikobot class
$requester = new Requester($user, $key);
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


## System requirements

* [PHP 7.1](http://php.net/releases/7_1_0.php)
* [ext-curl](http://php.net/curl)
* [ext-json](http://php.net/json)


## Installation

```bash
$ composer require inspirum/balikobot
```


## Version

Support all options for Balikobot API described in the [documentation][link-api] (v1.845, 2018-11-29).


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
$ composer test
```

To show coverage, run:

```bash
$ composer test-coverage
```

For testing purposes, you can use these credentials:

- **API username:** balikobot_test2cztest
- **API key:** #lS1tBVo


## Contributing

Please see [CONTRIBUTING][link-contributing] and [CODE_OF_CONDUCT][link-code-of-conduct] for details.


## Security

If you discover any security related issues, please email tomas.novotny@inspirum.cz instead of using the issue tracker.


## Credits

- [Tomáš Novotný][link-author]
- [All Contributors][link-contributors]


## License

The MIT License (MIT). Please see [License File][link-licence] for more information.


[ico-license]:              https://img.shields.io/github/license/inspirum/php-balikobot.svg?style=flat-square&colorB=blue
[ico-travis]:               https://img.shields.io/travis/inspirum/php-balikobot/master.svg?branch=master&style=flat-square
[ico-scrutinizer]:          https://img.shields.io/scrutinizer/coverage/g/inspirum/php-balikobot/master.svg?style=flat-square
[ico-code-quality]:         https://img.shields.io/scrutinizer/g/inspirum/php-balikobot.svg?style=flat-square
[ico-packagist-stable]:     https://img.shields.io/packagist/v/inspirum/balikobot.svg?style=flat-square&colorB=blue
[ico-packagist-download]:   https://img.shields.io/packagist/dt/inspirum/balikobot.svg?style=flat-square&colorB=blue
[ico-phpstan]:              https://img.shields.io/badge/style-level%207-brightgreen.svg?style=flat-square&label=phpstan

[link-author]:              https://github.com/inspirum
[link-contributors]:        https://github.com/inspirum/php-balikobot/contributors
[link-licence]:             ./LICENSE.md
[link-changelog]:           ./CHANGELOG.md
[link-contributing]:        ./docs/CONTRIBUTING.md
[link-code-of-conduct]:     ./docs/CODE_OF_CONDUCT.md
[link-travis]:              https://travis-ci.org/inspirum/php-balikobot
[link-scrutinizer]:         https://scrutinizer-ci.com/g/inspirum/php-balikobot/code-structure
[link-code-quality]:        https://scrutinizer-ci.com/g/inspirum/php-balikobot
[link-api]:                 https://www.balikobot.cz/dokumentace/Balikobot-dokumentace-API.pdf
[link-inspishop]:           https://www.inspishop.cz/
[link-inspirum]:            https://www.inspirum.cz/
[link-packagist-stable]:    https://packagist.org/packages/inspirum/balikobot
[link-packagist-download]:  https://packagist.org/packages/inspirum/balikobot
[link-phpstan]:             https://github.com/phpstan/phpstan
