# Package service

- [PackageService](./../src/Service/PackageService.php)
- [DefaultPackageService](./../src/Service/DefaultPackageService.php)

Package service provides methods that you will need for package handling (for classic, B2A and B2C shipping).

### Add packages

The **addPackages** method is used to add new packages for given carrier. 
Individual packages are created as instances of the class [**PackageData**](../src/Model/PackageData/PackageData.php), and they are transferred in [**PackageDataCollection**](../src/Model/PackageData/PackageDataCollection.php).

All available attributes (from [**Attribute**](../src/Definitions/Attribute.php)) for packages are accessible by setter methods in [**DefaultPackageData**](../src/Model/PackageData/DefaultPackageData.php) class.

The service normalizes the response by returning [**PackageCollection**](../src/Model/Package/PackageCollection.php) which encapsulate data returned from API.

```php
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageDataCollection;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageData;

$packagesData = new DefaultPackageDataCollection(Carrier::CP);

$packageData = new DefaultPackageData();
$packageData->setServiceType(Service::CP_NP);
$packageData->setRecName('Josef Novák');
$packageData->setPrice(1500);
$packageData->setRecStreet('Ulice 123');
$packageData->setRecCity('Praha');
$packageData->setRecZip('11000');
$packageData->setRecCountry(Country::CZECH_REPUBLIC);
$packageData->setReturnFullErrors();

$packagesData->add($packageData);

/** @var \Inspirum\Balikobot\Service\PackageService $packageService */
$packages = $packageService->addPackages($packagesData);

/*
var_dump($packages);
Inspirum\Balikobot\Model\Package\DefaultPackageCollection {
  private $carrier   => 'cp'
  private $labelsUrl => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwVcMBAXAC9.'
  private $items     => [
    0 => Inspirum\Balikobot\Model\Package\DefaultPackage {
      private $carrier   => 'cp'
      private $packageId => '42718'
      private $carrierId => 'NP1504102232M'
      private $trackUrl  => null
      private $labelUrl  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwVcMBAXAn4.'
      ...
    }
  ]
}
*/
```


### Drop packages

Drop created packages from Balikobot with **dropPackage** or **dropPackages** method.

These methods have no return value, only throws exception on error.

```php
/** @var \Inspirum\Balikobot\Service\PackageService $packageService */
$packages = $packageService->addPackages($packagesData);

$packageService->dropPackage($packages[0]);
```

or dropping all packages in collection

```php
/** @var \Inspirum\Balikobot\Service\PackageService $packageService */
$packageService->dropPackages($packages);
```


### Order shipment

To order shipment for packages use **orderShipment** method.

The service normalizes the response by returning [**OrderedShipment**](../src/Model/OrderedShipment/OrderedShipment.php) which encapsulate data returned from API.

```php
/** @var \Inspirum\Balikobot\Service\PackageService $packageService */
$orderedShipment = $packageService->orderShipment($packages);

/*
var_dump($orderedPackages);
Inspirum\Balikobot\Model\OrderedShipment\DefaultOrderedShipment {
  private $orderId     => '42718'
  private $handoverUrl => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NTW1MAVcMBAaAn4.'
  private $labelsUrl   => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwVcMBAXAn4.'
  private $fileUrl     => 'https://csv.balikobot.cz/cp/eNorMTIwt9A1sjAyB1wwDZECRr..'
  private $carrier     => 'cp'
  private $packageIds  => [
    '43619'
  ]
}
*/
```


# Track service

- [TrackService](./../src/Service/TrackService.php)
- [DefaultTrackService](./../src/Service/DefaultTrackService.php)

Track service provides methods for package status tracking.

Track added package status with **trackPackage** or **trackPackageLastStatus** method.

The service normalizes the response by returning collection of [**Status**](../src/Model/Status/Status.php) which encapsulate data returned from API.

```php
/** @var \Inspirum\Balikobot\Service\TrackService $trackService */
$statuses = $trackService->trackPackage($packages[0]);

/*
var_dump($statuses);
Inspirum\Balikobot\Model\Status\DefaultStatuses {
  private $carrier   => 'cp'
  private $carrierId => 'NP1504102232M'
  private $states    => Inspirum\Balikobot\Model\Status\DefaultStatusCollection {
    private $carrier => 'cp'
    private $items   => [
      0 => Inspirum\Balikobot\Model\Status\DefaultStatus {
        private $carrier     => 'cp'
        private $carrierId   => 'NP1504102232M'
        private $date        => DateTimeImmutable {
          public $date => '2018-07-02 00:00:00.000000'
        }
        private $id          => 2.2
        private $name        => 'Zásilka byla doručena příjemci.'
        private $description => 'Dodání zásilky. (77072 - Depo Olomouc 72)'
        private $type        => 'event'
      }
      1 => Inspirum\Balikobot\Model\Status\DefaultStatus {
        private $carrier     => 'cp'
        private $carrierId   => 'NP1504102232M'
        private $date        => DateTimeImmutable {
          public $date => '2018-07-02 00:00:00.000000'
        }
        private $id          => 1.2
        private $name        => 'Zásilka byla doručena příjemci.'
        private $description => 'E-mail odesílateli - dodání zásilky.'
        private $type        => 'notification'
      }
      ...
    ]
  }
}
*/

$status = $trackService->trackPackageLastStatus($packages[0]);

/*
var_dump($status);
Inspirum\Balikobot\Model\Status\DefaultStatus {
  private $carrier     => 'cp'
  private $carrierId   => 'NP1504102232M'
  private $date        => DateTimeImmutable {
    public $date => '2018-07-02 00:00:00.000000'
  }
  private $id          => 2.2
  private $name        => 'Zásilka byla doručena příjemci.'
  private $description => 'Dodání zásilky. (77072 - Depo Olomouc 72)'
  private $type        => 'event'
}
*/
```


# Branch service

- [BranchService](./../src/Service/BranchService.php)
- [DefaultBranchService](./../src/Service/DefaultBranchService.php)

Branch service provides methods that can be used to obtain branches for supported carriers. 

- Method **getBranchesForCarrierService** returns branches for specific carrier and service type.
- Method **getBranchesForCarrier** returns branches for all service types for specific carrier.
- Method **getBranches** returns branches for all supported carriers.

These methods return a large amount of data, therefore, these methods use [Generator](http://php.net/manual/en/class.generator.php) via [`yield`](http://php.net/manual/en/language.generators.syntax.php) keyword for returned data.
It saves a lot of memory and allows you to iterate all branches at one time in one cycle.

All methods allow filter branches by country.

```php
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\Service;

/** @var \Inspirum\Balikobot\Service\BranchService $branchService */
$branches = $branchService->getBranches();
$branches = $branchService->getBranchesForCarrier(Carrier::CP);
$branches = $branchService->getBranchesForCarrierService(Carrier::CP, Service::CP_NP);

$branches = $branchService->getBranchesForCountries([Country::CZECH_REPUBLIC, Country::SLOVAKIA]);
$branches = $branchService->getBranchesForCarrierAndCountries(Carrier::ZASILKOVNA, [Country::CZECH_REPUBLIC, Country::SLOVAKIA]);
$branches = $branchService->getBranchesForCarrierServiceAndCountries(Carrier::ZASILKOVNA, Service::ZASILKOVNA_VMCZ, [Country::CZECH_REPUBLIC, Country::SLOVAKIA]);

/*
var_dump($branches);
Inspirum\Balikobot\Model\Branch\DefaultBranchIterator {
    private $carrier   => 'cp'
    private $service   => 'np'
    private $countries => ['CZ', 'SK']
    private $iterator  => Generator {}
}
*/
```

Branch contains all possible attributes from **FULLBRANCH** API method.
Different carriers use different attribute as **branch_id** in **ADD** request, therefore [**DefaultBranch**](../src/Model/Branch/DefaultBranch.php) class already set proper **branch_id** for given carrier type.

```php
use Inspirum\Balikobot\Definitions\Carrier;

/** @var \Inspirum\Balikobot\Service\BranchService $branchService */
$branches = $branchService->getBranchesForCarrier(Carrier::CP);

foreach($branches as $branch) {
  /*
  var_dump($branch);
  Inspirum\Balikobot\Model\Branch\DefaultBranch {
    private $carrier  => 'cp'
    private $service  => 'NB'
    private $branchId => '10003'
    private $id       => null
    private $type     => 'branch'
    private $name     => 'Depo Praha 701'
    private $city     => ''
    private $street   => 'Sazečská 598/7, Malešice, 10003, Praha'
    private $zip      => '10003'
    private $cityPart => null
    private $district => null
    private $region   => null
    private $country  => 'CZ'
    ...
  }
  */
}
```


# Setting service

- [SettingService](./../src/Service/SettingService.php)
- [DefaultSettingService](./../src/Service/DefaultSettingService.php)

Setting service provides several helper methods to get needed package data (services options, attributes, manipulation units, ...).


# Info service

- [InfoService](./../src/Service/InfoService.php)
- [DefaultInfoService](./../src/Service/DefaultInfoService.php)

Info service provides methods (**getAccountInfo**, **getChangelog**) that you will probably not use in Balikobot API implementation.


# Providers

### Carrier provider

- [CarrierProvider](./../src/Provider/CarrierProvider.php)
- [DefaultCarrierProvider](./../src/Provider/DefaultCarrierProvider.php)
- [LiveCarrierProvider](./../src/Provider/LiveCarrierProvider.php)

Carrier provider get array of supported carriers, as list of constants, or from API response.

### Service provider

- [ServiceProvider](./../src/Provider/ServiceProvider.php)
- [DefaultServiceProvider](./../src/Provider/DefaultServiceProvider.php)
- [LiveServiceProvider](./../src/Provider/LiveServiceProvider.php)
  
Service provider get array of supported service types, as list of constants, or from API response.
