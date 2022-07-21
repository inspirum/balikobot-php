<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\BaseCollection;
use Inspirum\Balikobot\Client\Request\Carrier;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\Service\Service>
 */
final class ServiceCollection extends BaseCollection
{
    /**
     * @param array<int,\Inspirum\Balikobot\Model\Service\Service> $services
     */
    public function __construct(
        private readonly Carrier $carrier,
        readonly array $services,
        private readonly ?bool $parcel = null,
        private readonly ?bool $cargo = null,
    ) {
        parent::__construct($this->services);
    }

    public function getCarrier(): Carrier
    {
        return $this->carrier;
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
