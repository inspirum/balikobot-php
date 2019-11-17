<?php

namespace Inspirum\Balikobot\Model\Values;

use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;

class Branch
{
    /**
     * @var string
     */
    private $shipper;

    /**
     * @var string|null
     */
    private $service;

    /**
     * @var string
     */
    private $branchId;

    /**
     * @var string|null
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string|null
     */
    private $cityPart;

    /**
     * @var string|null
     */
    private $district;

    /**
     * @var string|null
     */
    private $region;

    /**
     * ISO 3166-1 alpha-2 http://cs.wikipedia.org/wiki/ISO_3166-1
     *
     * @var string|null
     */
    private $country;

    /**
     * @var string|null
     */
    private $currency;

    /**
     * @var string|null
     */
    private $photoSmall;

    /**
     * @var string|null
     */
    private $photoBig;

    /**
     * @var string|null
     */
    private $url;

    /**
     * @var float|null
     */
    private $latitude;

    /**
     * @var float|null
     */
    private $longitude;

    /**
     * @var string|null
     */
    private $directionsGlobal;

    /**
     * @var string|null
     */
    private $directionsCar;

    /**
     * @var string|null
     */
    private $directionsPublic;

    /**
     * @var bool|null
     */
    private $wheelchairAccessible;

    /**
     * @var bool|null
     */
    private $claimAssistant;

    /**
     * @var bool|null
     */
    private $dressingRoom;

    /**
     * @var string|null
     */
    private $openingMonday;

    /**
     * @var string|null
     */
    private $openingTuesday;

    /**
     * @var string|null
     */
    private $openingWednesday;

    /**
     * @var string|null
     */
    private $openingThursday;

    /**
     * @var string|null
     */
    private $openingFriday;

    /**
     * @var string|null null
     */
    private $openingSaturday = null;

    /**
     * @var string|null null
     */
    private $openingSunday = null;

    /**
     * Branch constructor
     *
     * @param string      $shipper
     * @param string|null $service
     * @param string|null $id
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
     */
    public function __construct(
        string $shipper,
        ?string $service,
        ?string $id,
        string $type,
        string $name,
        string $city,
        string $street,
        string $zip,
        string $country = null,
        string $cityPart = null,
        string $district = null,
        string $region = null,
        string $currency = null,
        string $photoSmall = null,
        string $photoBig = null,
        string $url = null,
        float $latitude = null,
        float $longitude = null,
        string $directionsGlobal = null,
        string $directionsCar = null,
        string $directionsPublic = null,
        bool $wheelchairAccessible = null,
        bool $claimAssistant = null,
        bool $dressingRoom = null,
        string $openingMonday = null,
        string $openingTuesday = null,
        string $openingWednesday = null,
        string $openingThursday = null,
        string $openingFriday = null,
        string $openingSaturday = null,
        string $openingSunday = null
    ) {
        $this->shipper              = $shipper;
        $this->service              = $service;
        $this->id                   = $id;
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

        $this->setBranchId();
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
     * Set branch ID
     *
     * @return void
     */
    private function setBranchId(): void
    {
        $this->branchId = $this->resolveBranchId();
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
     * @param string      $shipper
     * @param string|null $service
     * @param array       $data
     *
     * @return \Inspirum\Balikobot\Model\Values\Branch
     */
    public static function newInstanceFromData(string $shipper, ?string $service, array $data): self
    {
        return new self(
            $shipper,
            $service,
            $data['id'] ?? null,
            $data['type'] ?? 'branch',
            $data['name'] ?? $data['zip'],
            $data['city'] ?? '',
            $data['street'] ?? ($data['address'] ?? ''),
            $data['zip'],
            $data['country'] ?? null,
            $data['city_part'] ?? null,
            $data['district'] ?? null,
            $data['region'] ?? null,
            $data['currency'] ?? null,
            $data['photo_small'] ?? null,
            $data['photo_big'] ?? null,
            $data['url'] ?? null,
            $data['latitude'] ?? null,
            $data['longitude'] ?? null,
            $data['directions_global'] ?? null,
            $data['directions_car'] ?? null,
            $data['directions_public'] ?? null,
            $data['wheelchair_accessible'] ?? null,
            $data['claim_assistant'] ?? null,
            $data['dressing_room'] ?? null,
            $data['opening_monday'] ?? null,
            $data['opening_tuesday'] ?? null,
            $data['opening_wednesday'] ?? null,
            $data['opening_thursday'] ?? null,
            $data['opening_friday'] ?? null,
            $data['opening_saturday'] ?? null,
            $data['opening_sunday'] ?? null
        );
    }
}
