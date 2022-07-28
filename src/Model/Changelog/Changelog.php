<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use DateTimeInterface;
use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Changelog extends Model
{
    public function getVersion(): string;

    public function getDate(): DateTimeInterface;

    public function getChanges(): ChangelogStatusCollection;
}
