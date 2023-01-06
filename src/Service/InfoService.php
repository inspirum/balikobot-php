<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Model\Account\Account;
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
     * Get news in the Balikobot API
     *
     * @return \Inspirum\Balikobot\Model\Changelog\ChangelogCollection&array<\Inspirum\Balikobot\Model\Changelog\Changelog>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     * @throws \Exception
     */
    public function getChangelog(): ChangelogCollection;
}
