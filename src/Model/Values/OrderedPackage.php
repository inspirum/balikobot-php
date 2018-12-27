<?php

namespace Inspirum\Balikobot\Model\Values;

class OrderedPackage
{
    /**
     * Package ID.
     *
     * @var int
     */
    private $packageId;
    
    /**
     * Package batch ID (EID).
     *
     * @var string
     */
    private $batchId;
    
    /**
     * Shipper.
     *
     * @var string
     */
    private $shipper;
    
    /**
     * Carrier ID (for package tracking)
     *
     * @var string
     */
    private $carrierId;
    
    /**
     * Track URL.
     *
     * @var string|null
     */
    private $trackUrl;
    
    /**
     * Label URL
     *
     * @var string|null
     */
    private $labelUrl;
    
    /**
     * Carrier ID Swap.
     *
     * @var string|null
     */
    private $carrierIdSwap;
    
    /**
     * Pieces.
     *
     * @var array
     */
    private $pieces;
    
    /**
     * OrderedPackage constructor.
     *
     * @param int         $packageId
     * @param string      $shipper
     * @param string      $batchId
     * @param string      $carrierId
     * @param string|null $trackUrl
     * @param string|null $labelUrl
     * @param string|null $carrierIdSwap
     * @param array       $pieces
     */
    public function __construct(
        int $packageId,
        string $shipper,
        string $batchId,
        string $carrierId,
        string $trackUrl = null,
        string $labelUrl = null,
        string $carrierIdSwap = null,
        array $pieces = []
    ) {
        $this->packageId     = $packageId;
        $this->shipper       = $shipper;
        $this->batchId       = $batchId;
        $this->carrierId     = $carrierId;
        $this->trackUrl      = $trackUrl;
        $this->labelUrl      = $labelUrl;
        $this->carrierIdSwap = $carrierIdSwap;
        $this->pieces        = $pieces;
    }
    
    /**
     * @return int
     */
    public function getPackageId(): int
    {
        return $this->packageId;
    }
    
    /**
     * @return string
     */
    public function getBatchId(): string
    {
        return $this->batchId;
    }
    
    /**
     * @return string
     */
    public function getCarrierId(): string
    {
        return $this->carrierId;
    }
    
    /**
     * @return string|null
     */
    public function getTrackUrl(): ?string
    {
        return $this->trackUrl;
    }
    
    /**
     * @return string|null
     */
    public function getLabelUrl(): ?string
    {
        return $this->labelUrl;
    }
    
    /**
     * @return string|null
     */
    public function getCarrierIdSwap(): ?string
    {
        return $this->carrierIdSwap;
    }
    
    /**
     * @return array
     */
    public function getPieces(): array
    {
        return $this->pieces;
    }
    
    /**
     * @return string
     */
    public function getShipper(): string
    {
        return $this->shipper;
    }
    
    /**
     * @param string $shipper
     * @param string $eid
     * @param array  $data
     *
     * @return \Inspirum\Balikobot\Model\Values\OrderedPackage
     */
    public static function newInstanceFromData(string $shipper, string $eid, array $data): self
    {
        return new self(
            $data['package_id'],
            $shipper,
            $eid,
            $data['carrier_id'],
            $data['track_url'] ?? null,
            $data['label_url'],
            $data['carrier_id_swap'] ?? null,
            $data['pieces'] ?? []
        );
    }
}
