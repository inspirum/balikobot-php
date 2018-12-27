<?php

namespace Inspirum\Balikobot\Model\Values;

use Inspirum\Balikobot\Model\Values\Package\CashOnDeliveryData;
use Inspirum\Balikobot\Model\Values\Package\CustomerData;
use Inspirum\Balikobot\Model\Values\Package\DeliveryData;
use Inspirum\Balikobot\Model\Values\Package\ForeignCountryDeliveryData;
use Inspirum\Balikobot\Model\Values\Package\NotificationData;
use Inspirum\Balikobot\Model\Values\Package\PackageData;
use Inspirum\Balikobot\Model\Values\Package\ParcelPackageData;

class Package extends AbstractPackage
{
    use CashOnDeliveryData;
    use CustomerData;
    use DeliveryData;
    use ForeignCountryDeliveryData;
    use NotificationData;
    use PackageData;
    use ParcelPackageData;
}
