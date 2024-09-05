<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\Service\Service>
 */
interface ServiceCollection extends ListCollection
{
    public function getCarrier(): string;

    /**
     * @return list<\Inspirum\Balikobot\Model\Service\Service>
     */
    public function getServices(): array;

    /**
     * @return list<string>
     */
    public function getServiceCodes(): array;

    public function supportsParcel(): ?bool;

    public function supportsCargo(): ?bool;
}
