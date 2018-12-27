# Balikobot

Service [**Inspirum\Balikobot\Services\Balikobot**](../src/Services/Balikobot.php) is extension over [Client](./client.md#client) that uses custom [DTO](https://en.wikipedia.org/wiki/Data_transfer_object) classes as an input and output for its methods.


## Packages

Using plain API with [Client](./client.md#client) can be very difficult even with normalized return format. 

**Balikobot** service add DTO classes to ease to use with simple interfaces and user-friendly *getter* and *setter* methods.

- [**Inspirum\Model\Values\Branch**](../src/Model/Values/Branch.php)
- [**Inspirum\Model\Values\OrderedPackage**](../src/Model/Values/OrderedPackage.php)
- [**Inspirum\Model\Values\OrderedShipment**](../src/Model/Values/OrderedShipment.php)
- [**Inspirum\Model\Values\Package**](../src/Model/Values/Package.php)
- [**Inspirum\Model\Values\PackageStatus**](../src/Model/Values/PackageStatus.php)
- [**Inspirum\Model\Values\PostCode**](../src/Model/Values/PostCode.php)
- [**Inspirum\Model\Aggregates\OrderedPackageCollection**](../src/Model/Aggregates/OrderedPackageCollection.php)
- [**Inspirum\Model\Aggregates\PackageCollection**](../src/Model/Aggregates/PackageCollection.php)


### Add packages

The **addPackages** method is used to add new packages for given shipper. 
Individual packages are created as instances of the class [**Package**](../src/Model/Values/Package.php), and they are transfered in [**PackageCollection**](../src/Model/Aggregates/PackageCollection.php).
All available options for packages are accessible by setter methods in [**Package**](../src/Model/Values/Package.php) class.

The service normalizes the response by returning [**OrderedPackageCollection**](../src/Model/Aggregates/OrderedPackageCollection.php) which encapsulate data returned from [Client](./client.md#client).

```php
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Services\Balikobot;

$balikobot = new Balikobot($user, $key);

$packages = new PackageCollection(Shipper::CP);

$package = new Package();
$package->setServiceType(ServiceType::CP_NP);
$package->setRecName("Josef Novák");
$package->setPrice(1500);
$package->setRecStreet("Ulice 123");
$package->setRecCity("Praha");
$package->setRecZip("11000");
$package->setRecCountry(Country::CZECH_REPUBLIC);
$package->setReturnFullErrors();

$packages->add($package);

$orderedPackages = $balikobot->addPackages($packages);

/*
var_dump($orderedPackages);
Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection {
  private $shipper  => "cp"
  private $packages => [
    0 => Inspirum\Balikobot\Model\Values\OrderedPackage {
      private $shipper   => "cp"
      private $packageId => "42718"
      private $carrierId => "NP1504102232M"
      private $trackUrl  => NULL
      private $labelUrl  => "https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwVcMBAXAn4."
      ...
    }
  ]
}
*/
```


### Drop packages

Drop created packages from Balikobot with **dropPackage** or **dropPackages** method.

These methods has no return value, only throws exception on error, same as [**DROP**](./client.md#drop) request.

```php
$orderedPackages = $balikobot->addPackages($packages);

$balikobot->dropPackage($orderedPackages[0]);
```

or dropping all packages in collection

```php
$balikobot->dropPackages($orderedPackages);
```


### Order shipment

To order shipment for packages use **orderShipment** method.

The service normalizes the response by returning [**OrderedShipment.php**](../src/Model/Values/OrderedShipment.php) which encapsulate data returned from [Client](./client.md#client).

```php
$orderedShipment = $balikobot->orderShipment($orderedPackages);

/*
var_dump($orderedPackages);
Inspirum\Balikobot\Model\Values\OrderedShipment {
  private $orderId     => "42718"
  private $handoverUrl => "https://pdf.balikobot.cz/cp/eNorMTIwt9A1NTW1MAVcMBAaAn4."
  private $labelsUrl   => "https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwVcMBAXAn4."
  private $fileUrl     => "https://csv.balikobot.cz/cp/eNorMTIwt9A1sjAyB1wwDZECRr.."
  private $date        => NULL
  private $shipper     => "cp"
  private $packageIds  => [
    "43619"
  ]
}
*/
```


### Track packages

Track added package status with **trackPackage method**.

The service normalizes the response by returning [**PackageStatus.php**](../src/Model/Values/PackageStatus.php) which encapsulate data returned from [Client](./client.md#client).

```php
$statuses = $balikobot->trackPackage($orderedPackages[0]);

/*
var_dump($statuses);
[
  0 => Inspirum\Balikobot\Model\Values\PackageStatus {
    private $date => DateTime {
      public $date => "2018-07-02 00:00:00.000000"
    }
    private $id   => 2
    private $name => "Dodání zásilky. 10003 Depo Praha 701"
  }
  1 => Inspirum\Balikobot\Model\Values\PackageStatus {
    private $date => DateTime {
      public $date => "2018-07-02 00:00:00.000000"
    }
    private $id   => 1
    private $name => "Doručování zásilky. 10003 Depo Praha 701"
  }
  ...
]
*/
```


## Branches

Several methods can be used to obtain branches for supported shippers. 
- Method **getBranchesForShipperService** returns branches for specific shipper and service type.
- Method **getBranchesForShipper** returns branches for all service types for specific shipper.
- Method **getBranches** returns branches for all supported shippers.

These methods return a large amount of data, therefore, these methods use [Generator](http://php.net/manual/en/class.generator.php) via [`yield`](http://php.net/manual/en/language.generators.syntax.php) keyword for returned data.
It saves a lot of memory and allows you to iterate all branches at one time in one cycle.

```php
$shippers = $balikobot->getBranches():
$shippers = $balikobot->getBranchesForShipper(Shipper::CP);
$shippers = $balikobot->getBranchesForShipperService(Shipper::CP, ServiceType::CP_NP);

/*
var_dump($shippers);
Generator {}
*/
```

Branch contains all possible attributes from [**FULLBRANCH**](./client.md#fullbranches) request.
Different shippers use different attribute as **branch_id** in [**ADD**](./client.md#add) request, therefore [**Branch**](../src/Model/Values/Branch.php) class already set proper **branch_id** for given shipper type.

```php
$shippers = $balikobot->getBranchesForShipper(Shipper::CP):
í
foreach($shippers as $shipper) {
  
  /*
  var_dump($shipper);
  Inspirum\Balikobot\Model\Values\Branch {
    private $shipper  => "cp"
    private $service  => "NB"
    private $branchId => "10003"
    private $id       => NULL
    private $type     => "branch"
    private $name     => "Depo Praha 701"
    private $city     => ""
    private $street   => "Sazečská 598/7, Malešice, 10003, Praha"
    private $zip      => "10003"
    private $cityPart => NULL
    private $district => NULL
    private $region   => NULL
    private $country  => "CZ"
    ...
  }
  */
}
```

***


## More usage


### [**Definitons**](./definitions.md)

The module contains several helper classes that contain most of the constants needed to work with the Balikobot API.


### [**Client**](./client.md)

Support all options for Balikobot API described in given documentation.
