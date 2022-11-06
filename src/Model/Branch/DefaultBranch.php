<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultBranch extends BaseModel implements Branch
{
    public function __construct(
        private string $carrier,
        private ?string $service,
        private string $branchId,
        private ?string $id,
        private ?string $uid,
        private string $type,
        private string $name,
        private string $city,
        private string $street,
        private string $zip,
        private ?string $country = null,
        private ?string $cityPart = null,
        private ?string $district = null,
        private ?string $region = null,
        private ?string $currency = null,
        private ?string $photoSmall = null,
        private ?string $photoBig = null,
        private ?string $url = null,
        private ?float $latitude = null,
        private ?float $longitude = null,
        private ?string $directionsGlobal = null,
        private ?string $directionsCar = null,
        private ?string $directionsPublic = null,
        private ?bool $wheelchairAccessible = null,
        private ?bool $claimAssistant = null,
        private ?bool $dressingRoom = null,
        private ?string $openingMonday = null,
        private ?string $openingTuesday = null,
        private ?string $openingWednesday = null,
        private ?string $openingThursday = null,
        private ?string $openingFriday = null,
        private ?string $openingSaturday = null,
        private ?string $openingSunday = null,
        private ?float $maxWeight = null,
    ) {
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function getBranchId(): string
    {
        return $this->branchId;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getCityPart(): ?string
    {
        return $this->cityPart;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getPhotoSmall(): ?string
    {
        return $this->photoSmall;
    }

    public function getPhotoBig(): ?string
    {
        return $this->photoBig;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function getDirectionsGlobal(): ?string
    {
        return $this->directionsGlobal;
    }

    public function getDirectionsCar(): ?string
    {
        return $this->directionsCar;
    }

    public function getDirectionsPublic(): ?string
    {
        return $this->directionsPublic;
    }

    public function getWheelchairAccessible(): ?bool
    {
        return $this->wheelchairAccessible;
    }

    public function getClaimAssistant(): ?bool
    {
        return $this->claimAssistant;
    }

    public function getDressingRoom(): ?bool
    {
        return $this->dressingRoom;
    }

    public function getOpeningMonday(): ?string
    {
        return $this->openingMonday;
    }

    public function getOpeningTuesday(): ?string
    {
        return $this->openingTuesday;
    }

    public function getOpeningWednesday(): ?string
    {
        return $this->openingWednesday;
    }

    public function getOpeningThursday(): ?string
    {
        return $this->openingThursday;
    }

    public function getOpeningFriday(): ?string
    {
        return $this->openingFriday;
    }

    public function getOpeningSaturday(): ?string
    {
        return $this->openingSaturday;
    }

    public function getOpeningSunday(): ?string
    {
        return $this->openingSunday;
    }

    public function getMaxWeight(): ?float
    {
        return $this->maxWeight;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'carrier'  => $this->carrier,
            'service'  => $this->service,
            'branchId' => $this->branchId,
            'id'       => $this->id,
            'uid'      => $this->uid,
            // TODO:
        ];
    }
}
