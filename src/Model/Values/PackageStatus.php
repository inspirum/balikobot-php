<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Values;

use DateTime;
use Throwable;

class PackageStatus
{
    /**
     * @var float
     */
    private float $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var string
     */
    private string $type;

    /**
     * @var \DateTime|null
     */
    private ?DateTime $date;

    /**
     * PackageStatus constructor
     *
     * @param float          $id
     * @param string         $type
     * @param string         $name
     * @param string         $description
     * @param \DateTime|null $date
     */
    public function __construct(float $id, string $type, string $name, string $description, ?DateTime $date = null)
    {
        $this->id          = $id;
        $this->type        = $type;
        $this->name        = $name;
        $this->description = $description;
        $this->date        = $date;
    }

    /**
     * @return float
     */
    public function getId(): float
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return (int) $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Values\PackageStatus
     */
    public static function newInstanceFromData(array $data): self
    {
        try {
            $date = $data['date'] ? new DateTime($data['date']) : null;
        } catch (Throwable $exception) {
            $date = null;
        }

        return new self(
            $data['status_id_v2'] ?? $data['status_id'],
            $data['type'] ?? 'event',
            $data['name_balikobot'] ?? ($data['name_internal'] ?? $data['name']),
            $data['name'],
            $date
        );
    }
}
