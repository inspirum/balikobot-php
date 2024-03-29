<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData;

use Inspirum\Balikobot\Model\PackageData\Package\CashOnDeliveryData;
use Inspirum\Balikobot\Model\PackageData\Package\CustomerData;
use Inspirum\Balikobot\Model\PackageData\Package\DeliveryData;
use Inspirum\Balikobot\Model\PackageData\Package\ForeignCountryDeliveryData;
use Inspirum\Balikobot\Model\PackageData\Package\NeutralizeData;
use Inspirum\Balikobot\Model\PackageData\Package\NotificationData;
use Inspirum\Balikobot\Model\PackageData\Package\ParcelData;
use Inspirum\Balikobot\Model\PackageData\Package\ParcelPackageData;
use Inspirum\Balikobot\Model\PackageData\Package\SenCustomerData;

final class DefaultPackageData extends BasePackageData
{
    use CashOnDeliveryData;
    use CustomerData;
    use SenCustomerData;
    use DeliveryData;
    use ForeignCountryDeliveryData;
    use NotificationData;
    use ParcelData;
    use ParcelPackageData;
    use NeutralizeData;
}
