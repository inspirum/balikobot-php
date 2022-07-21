<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Model\Account\Account;
use Inspirum\Balikobot\Model\Carrier\Carrier as CarrierModel;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Model\Changelog\ChangelogCollection;

interface InfoService
{
    /**
     * Get info about account
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getAccountInfo(): Account;

    /**
     * Get list of carriers
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getCarriers(): CarrierCollection;

    /**
     * Get info about carrier
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getCarrier(Carrier $carrier): CarrierModel;

    /**
     * Get news in the Balikobot API
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getChangelog(): ChangelogCollection;
}
