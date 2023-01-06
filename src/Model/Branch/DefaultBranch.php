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
        private readonly string $carrier,
        private readonly ?string $service,
        private readonly string $branchId,
        private readonly ?string $id,
        private readonly ?string $uid,
        private readonly string $type,
        private readonly string $name,
        private readonly string $city,
        private readonly string $street,
        private readonly string $zip,
        private readonly ?string $country = null,
        private readonly ?string $cityPart = null,
        private readonly ?string $district = null,
        private readonly ?string $region = null,
        private readonly ?string $currency = null,
        private readonly ?string $photoSmall = null,
        private readonly ?string $photoBig = null,
        private readonly ?string $url = null,
        private readonly ?float $latitude = null,
        private readonly ?float $longitude = null,
        private readonly ?string $directionsGlobal = null,
        private readonly ?string $directionsCar = null,
        private readonly ?string $directionsPublic = null,
        private readonly ?bool $wheelchairAccessible = null,
        private readonly ?bool $claimAssistant = null,
        private readonly ?bool $dressingRoom = null,
        private readonly ?string $openingMonday = null,
        private readonly ?string $openingTuesday = null,
        private readonly ?string $openingWednesday = null,
        private readonly ?string $openingThursday = null,
        private readonly ?string $openingFriday = null,
        private readonly ?string $openingSaturday = null,
        private readonly ?string $openingSunday = null,
        private readonly ?float $maxWeight = null,
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
