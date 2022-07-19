<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\BaseCollection;
use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Client\Request\ServiceType;
use function array_map;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\Service\Service>
 */
final class ServiceCollection extends BaseCollection
{
    /**
     * @param array<int,\Inspirum\Balikobot\Model\Service\Service> $services
     */
    public function __construct(
        private readonly CarrierType $carrier,
        private readonly array $services,
        private readonly ?bool $parcel = null,
        private readonly ?bool $cargo = null,
    ) {
        parent::__construct($this->services);
    }

    public function getCarrier(): CarrierType
    {
        return $this->carrier;
    }

    /**
     * @return array<\Inspirum\Balikobot\Client\Request\ServiceType>
     */
    public function getServiceTypes(): array
    {
        return array_map(static fn(Service $service): ServiceType => $service, $this->services);
    }

    public function supportsParcel(): ?bool
    {
        return $this->parcel;
    }

    public function supportsCargo(): ?bool
    {
        return $this->cargo;
    }
}
