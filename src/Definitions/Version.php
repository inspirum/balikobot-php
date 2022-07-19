<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

enum Version: string implements \Inspirum\Balikobot\Client\Request\Version
{
    case V1V1 = 'https://api.balikobot.cz';
    case V1V2 = 'https://api.balikobot.cz/v2';
    case V1V3 = 'https://api.balikobot.cz/v3';
    case V2V1 = 'https://apiv2.balikobot.cz';
    case V2V2 = 'https://apiv2.balikobot.cz/v2';

    public function getValue(): string
    {
        return $this->value;
    }
}
