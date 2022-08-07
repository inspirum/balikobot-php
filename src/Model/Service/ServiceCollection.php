<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\Service\Service>
 */
interface ServiceCollection extends Collection
{
    public function getCarrier(): string;

    /**
     * @return array<int,\Inspirum\Balikobot\Model\Service\Service>
     */
    public function getServices(): array;

    /**
     * @return array<string>
     */
    public function getServiceCodes(): array;

    public function supportsParcel(): ?bool;

    public function supportsCargo(): ?bool;
}
