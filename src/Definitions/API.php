<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

final class API
{
    /**
     * APIv1 version 1
     *
     * @var string
     */
    public const V1 = 'v1';

    /**
     * APIv1 version 2
     *
     * @var string
     */
    public const V2 = 'v2';

    /**
     * APIv1 version 3
     *
     * @var string
     */
    public const V3 = 'v3';

    /**
     * APIv2 version 1
     *
     * @var string
     */
    public const V2V1 = 'v2v1';

    /**
     * APIv2 version 2
     *
     * @var string
     */
    public const V2V2 = 'v2v2';

    /**
     * API URL
     *
     * @internal
     *
     * @var array<string,string>
     */
    public const URL = [
        self::V1   => 'https://api.balikobot.cz/',
        self::V2   => 'https://api.balikobot.cz/v2/',
        self::V3   => 'https://api.balikobot.cz/v3/',
        self::V2V1 => 'https://apiv2.balikobot.cz/',
        self::V2V2 => 'https://apiv2.balikobot.cz/v2/',
    ];
}
