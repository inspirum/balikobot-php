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
     * API latest version
     *
     * @var string
     */
    public const LATEST = self::V2;

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
    ];
}
