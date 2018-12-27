<?php

namespace Inspirum\Balikobot\Model\Values;

use DateTime;

class OrderedShipment
{
    /**
     * @var string
     */
    private $orderId;
    
    /**
     * @var string
     */
    private $handoverUrl;
    
    /**
     * @var string
     */
    private $labelsUrl;
    
    /**
     * @var string|null
     */
    private $fileUrl;
    
    /**
     * @var \DateTime|null
     */
    private $date;
    
    /**
     * @var string
     */
    private $shipper;
    
    /**
     * @var int[]
     */
    private $packageIds;
    
    /**
     * OrderedShipment constructor.
     *
     * @param string         $orderId
     * @param string         $shipper
     * @param array          $packageIds
     * @param string         $handoverUrl
     * @param string         $labelsUrl
     * @param string|null    $fileUrl
     * @param \DateTime|null $date
     */
    public function __construct(
        string $orderId,
        string $shipper,
        array $packageIds,
        string $handoverUrl,
        string $labelsUrl,
        DateTime $date = null,
        string $fileUrl = null
    ) {
        $this->orderId     = $orderId;
        $this->shipper     = $shipper;
        $this->packageIds  = $packageIds;
        $this->handoverUrl = $handoverUrl;
        $this->labelsUrl   = $labelsUrl;
        $this->date        = $date;
        $this->fileUrl     = $fileUrl;
    }
    
    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }
    
    /**
     * @return string
     */
    public function getHandoverUrl(): string
    {
        return $this->handoverUrl;
    }
    
    /**
     * @return string
     */
    public function getLabelsUrl(): string
    {
        return $this->labelsUrl;
    }
    
    /**
     * @return string|null
     */
    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }
    
    /**
     * @return \DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }
    
    /**
     * @return string
     */
    public function getShipper(): string
    {
        return $this->shipper;
    }
    
    /**
     * Get package IDs.
     *
     * @return int[]
     */
    public function getPackageIds(): array
    {
        return $this->packageIds;
    }
    
    /**
     * @param string         $shipper
     * @param array          $packageIds
     * @param array          $data
     * @param \DateTime|null $date
     *
     * @return \Inspirum\Balikobot\Model\Values\OrderedShipment
     */
    public static function newInstanceFromData(
        string $shipper,
        array $packageIds,
        array $data,
        DateTime $date = null
    ): self {
        return new self(
            $data['order_id'],
            $shipper,
            $packageIds,
            $data['handover_url'],
            $data['labels_url'],
            $date,
            $data['file_url'] ?? null
        );
    }
}
