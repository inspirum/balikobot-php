<?php

namespace Inspirum\Balikobot\Definitions;

final class API
{
    /**
     * API version 1
     *
     * @var string
     */
    public const V1 = 'v1';

    /**
     * API version 2
     *
     * @var string
     */
    public const V2 = 'v2';

    /**
     * API version 3
     *
     * @var string
     */
    public const V3 = 'v3';

    /**
     * API URL
     *
     * @internal
     *
     * @var array<string,string>
     */
    public const URL = [
        self::V1 => 'https://api.balikobot.cz/',
        self::V2 => 'https://api.balikobot.cz/v2/',
        self::V3 => 'https://api.balikobot.cz/v3/',
    ];
}
