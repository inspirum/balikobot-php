<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Client\Request\Service;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class Branch extends BaseModel
{
    public function __construct(
        public readonly Carrier $carrier,
        public readonly ?Service $service,
        public readonly string $branchId,
        public readonly ?string $id,
        public readonly ?string $uid,
        public readonly string $type,
        public readonly string $name,
        public readonly string $city,
        public readonly string $street,
        public readonly string $zip,
        public readonly ?string $country = null,
        public readonly ?string $cityPart = null,
        public readonly ?string $district = null,
        public readonly ?string $region = null,
        public readonly ?string $currency = null,
        public readonly ?string $photoSmall = null,
        public readonly ?string $photoBig = null,
        public readonly ?string $url = null,
        public readonly ?float $latitude = null,
        public readonly ?float $longitude = null,
        public readonly ?string $directionsGlobal = null,
        public readonly ?string $directionsCar = null,
        public readonly ?string $directionsPublic = null,
        public readonly ?bool $wheelchairAccessible = null,
        public readonly ?bool $claimAssistant = null,
        public readonly ?bool $dressingRoom = null,
        public readonly ?string $openingMonday = null,
        public readonly ?string $openingTuesday = null,
        public readonly ?string $openingWednesday = null,
        public readonly ?string $openingThursday = null,
        public readonly ?string $openingFriday = null,
        public readonly ?string $openingSaturday = null,
        public readonly ?string $openingSunday = null,
        public readonly ?float $maxWeight = null
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'carrier'  => $this->carrier->getValue(),
            'service'  => $this->service,
            'branchId' => $this->branchId,
            'id'       => $this->id,
            'uid'      => $this->uid,
        ];
    }
}
