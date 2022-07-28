<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,string>
 */
interface ChangelogStatus extends Model
{
    public function getName(): string;

    public function getDescription(): string;
}
