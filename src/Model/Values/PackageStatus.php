<?php

namespace Inspirum\Balikobot\Model\Values;

use DateTime;
use Throwable;

class PackageStatus
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime|null
     */
    private $date;

    /**
     * PackageStatus constructor.
     *
     * @param int            $id
     * @param string         $name
     * @param \DateTime|null $date
     */
    public function __construct(int $id, string $name, DateTime $date = null)
    {
        $this->id   = $id;
        $this->name = $name;
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @param array $data
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

        return new self($data['status_id'], $data['name'], $date);
    }
}
