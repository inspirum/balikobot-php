<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Values;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Factories\BranchFactory;
use function str_replace;

class Branch
{
    /**
     * @var string
     */
    private string $shipper;

    /**
     * @var string|null
     */
    private ?string $service;

    /**
     * @var string
     */
    private string $branchId;

    /**
     * @var string|null
     */
    private ?string $id;

    /**
     * @var string|null
     */
    private ?string $uid;

    /**
     * @var string
     */
    private string $type;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $city;

    /**
     * @var string
     */
    private string $street;

    /**
     * @var string
     */
    private string $zip;

    /**
     * @var string|null
     */
    private ?string $cityPart;

    /**
     * @var string|null
     */
    private ?string $district;

    /**
     * @var string|null
     */
    private ?string $region;

    /**
     * ISO 3166-1 alpha-2 http://cs.wikipedia.org/wiki/ISO_3166-1
     *
     * @var string|null
     */
    private ?string $country;

    /**
     * @var string|null
     */
    private ?string $currency;

    /**
     * @var string|null
     */
    private ?string $photoSmall;

    /**
     * @var string|null
     */
    private ?string $photoBig;

    /**
     * @var string|null
     */
    private ?string $url;

    /**
     * @var float|null
     */
    private ?float $latitude;

    /**
     * @var float|null
     */
    private ?float $longitude;

    /**
     * @var string|null
     */
    private ?string $directionsGlobal;

    /**
     * @var string|null
     */
    private ?string $directionsCar;

    /**
     * @var string|null
     */
    private ?string $directionsPublic;

    /**
     * @var bool|null
     */
    private ?bool $wheelchairAccessible;

    /**
     * @var bool|null
     */
    private ?bool $claimAssistant;

    /**
     * @var bool|null
     */
    private ?bool $dressingRoom;

    /**
     * @var string|null
     */
    private ?string $openingMonday;

    /**
     * @var string|null
     */
    private ?string $openingTuesday;

    /**
     * @var string|null
     */
    private ?string $openingWednesday;

    /**
     * @var string|null
     */
    private ?string $openingThursday;

    /**
     * @var string|null
     */
    private ?string $openingFriday;

    /**
     * @var string|null
     */
    private ?string $openingSaturday;

    /**
     * @var string|null
     */
    private ?string $openingSunday;

    /**
     * @var float|null
     */
    private ?float $maxWeight;

    /**
     * Branch constructor
     *
     * @param string      $shipper
     * @param string|null $service
     * @param string|null $id
     * @param string|null $uid
     * @param string      $type
     * @param string      $name
     * @param string      $city
     * @param string      $street
     * @param string      $zip
     * @param string|null $country
     * @param string|null $cityPart
     * @param string|null $district
     * @param string|null $region
     * @param string|null $currency
     * @param string|null $photoSmall
     * @param string|null $photoBig
     * @param string|null $url
     * @param float|null  $latitude
     * @param float|null  $longitude
     * @param string|null $directionsGlobal
     * @param string|null $directionsCar
     * @param string|null $directionsPublic
     * @param bool|null   $wheelchairAccessible
     * @param bool|null   $claimAssistant
     * @param bool|null   $dressingRoom
     * @param string|null $openingMonday
     * @param string|null $openingTuesday
     * @param string|null $openingWednesday
     * @param string|null $openingThursday
     * @param string|null $openingFriday
     * @param string|null $openingSaturday
     * @param string|null $openingSunday
     * @param float|null  $maxWeight
     */
    public function __construct(
        string $shipper,
        ?string $service,
        ?string $id,
        ?string $uid,
        string $type,
        string $name,
        string $city,
        string $street,
        string $zip,
        ?string $country = null,
        ?string $cityPart = null,
        ?string $district = null,
        ?string $region = null,
        ?string $currency = null,
        ?string $photoSmall = null,
        ?string $photoBig = null,
        ?string $url = null,
        ?float $latitude = null,
        ?float $longitude = null,
        ?string $directionsGlobal = null,
        ?string $directionsCar = null,
        ?string $directionsPublic = null,
        ?bool $wheelchairAccessible = null,
        ?bool $claimAssistant = null,
        ?bool $dressingRoom = null,
        ?string $openingMonday = null,
        ?string $openingTuesday = null,
        ?string $openingWednesday = null,
        ?string $openingThursday = null,
        ?string $openingFriday = null,
        ?string $openingSaturday = null,
        ?string $openingSunday = null,
        ?float $maxWeight = null
    ) {
        $this->shipper              = $shipper;
        $this->service              = $service;
        $this->id                   = $id;
        $this->uid                  = $uid;
        $this->type                 = $type;
        $this->name                 = $name;
        $this->city                 = $city;
        $this->street               = $street;
        $this->zip                  = $zip;
        $this->cityPart             = $cityPart;
        $this->district             = $district;
        $this->region               = $region;
        $this->country              = $country;
        $this->currency             = $currency;
        $this->photoSmall           = $photoSmall;
        $this->photoBig             = $photoBig;
        $this->url                  = $url;
        $this->latitude             = $latitude;
        $this->longitude            = $longitude;
        $this->directionsGlobal     = $directionsGlobal;
        $this->directionsCar        = $directionsCar;
        $this->directionsPublic     = $directionsPublic;
        $this->wheelchairAccessible = $wheelchairAccessible;
        $this->claimAssistant       = $claimAssistant;
        $this->dressingRoom         = $dressingRoom;
        $this->openingMonday        = $openingMonday;
        $this->openingTuesday       = $openingTuesday;
        $this->openingWednesday     = $openingWednesday;
        $this->openingThursday      = $openingThursday;
        $this->openingFriday        = $openingFriday;
        $this->openingSaturday      = $openingSaturday;
        $this->openingSunday        = $openingSunday;
        $this->maxWeight            = $maxWeight;
        $this->branchId             = $this->resolveBranchId();
    }

    /**
     * @return string
     */
    public function getShipper(): string
    {
        return $this->shipper;
    }

    /**
     * @return string|null
     */
    public function getServiceType(): ?string
    {
        return $this->service;
    }

    /**
     * @return string
     */
    public function getBranchId(): string
    {
        return $this->branchId;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUId(): ?string
    {
        return $this->uid;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @return string|null
     */
    public function getCityPart(): ?string
    {
        return $this->cityPart;
    }

    /**
     * @return string|null
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @return string|null
     */
    public function getPhotoSmall(): ?string
    {
        return $this->photoSmall;
    }

    /**
     * @return string|null
     */
    public function getPhotoBig(): ?string
    {
        return $this->photoBig;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @return string|null
     */
    public function getDirectionsGlobal(): ?string
    {
        return $this->directionsGlobal;
    }

    /**
     * @return string|null
     */
    public function getDirectionsCar(): ?string
    {
        return $this->directionsCar;
    }

    /**
     * @return string|null
     */
    public function getDirectionsPublic(): ?string
    {
        return $this->directionsPublic;
    }

    /**
     * @return bool|null
     */
    public function getWheelchairAccessible(): ?bool
    {
        return $this->wheelchairAccessible;
    }

    /**
     * @return bool|null
     */
    public function getClaimAssistant(): ?bool
    {
        return $this->claimAssistant;
    }

    /**
     * @return bool|null
     */
    public function getDressingRoom(): ?bool
    {
        return $this->dressingRoom;
    }

    /**
     * @return string|null
     */
    public function getOpeningMonday(): ?string
    {
        return $this->openingMonday;
    }

    /**
     * @return string|null
     */
    public function getOpeningTuesday(): ?string
    {
        return $this->openingTuesday;
    }

    /**
     * @return string|null
     */
    public function getOpeningWednesday(): ?string
    {
        return $this->openingWednesday;
    }

    /**
     * @return string|null
     */
    public function getOpeningThursday(): ?string
    {
        return $this->openingThursday;
    }

    /**
     * @return string|null
     */
    public function getOpeningFriday(): ?string
    {
        return $this->openingFriday;
    }

    /**
     * @return string|null
     */
    public function getOpeningSaturday(): ?string
    {
        return $this->openingSaturday;
    }

    /**
     * @return string|null
     */
    public function getOpeningSunday(): ?string
    {
        return $this->openingSunday;
    }

    /**
     * @return float|null
     */
    public function getMaxWeight(): ?float
    {
        return $this->maxWeight;
    }

    /**
     * Resolve branch ID
     *
     * @return string
     */
    private function resolveBranchId(): string
    {
        // get key used in branch_id when calling add request
        if (
            $this->shipper === Shipper::CP
            || $this->shipper === Shipper::SP
            || ($this->shipper === Shipper::ULOZENKA && $this->service === ServiceType::ULOZENKA_CP_NP)
        ) {
            return str_replace(' ', '', $this->zip);
        }

        if ($this->shipper === Shipper::PPL) {
            return str_replace('KM', '', (string) $this->id);
        }

        if ($this->shipper === Shipper::INTIME) {
            return $this->name;
        }

        return (string) $this->id;
    }

    /**
     * New instance from data
     *
     * @param string              $shipper
     * @param string|null         $service
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Values\Branch
     */
    public static function newInstanceFromData(string $shipper, ?string $service, array $data): self
    {
        return BranchFactory::createFromData($shipper, $service, $data);
    }
}
