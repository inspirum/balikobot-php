<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Branch extends Model
{
    public function getCarrier(): string;

    public function getService(): ?string;

    public function getBranchId(): string;

    public function getId(): ?string;

    public function getUid(): ?string;

    public function getType(): string;

    public function getName(): string;

    public function getCity(): string;

    public function getStreet(): string;

    public function getZip(): string;

    public function getCountry(): ?string;

    public function getCityPart(): ?string;

    public function getDistrict(): ?string;

    public function getRegion(): ?string;

    public function getCurrency(): ?string;

    public function getPhotoSmall(): ?string;

    public function getPhotoBig(): ?string;

    public function getUrl(): ?string;

    public function getLatitude(): ?float;

    public function getLongitude(): ?float;

    public function getDirectionsGlobal(): ?string;

    public function getDirectionsCar(): ?string;

    public function getDirectionsPublic(): ?string;

    public function getWheelchairAccessible(): ?bool;

    public function getClaimAssistant(): ?bool;

    public function getDressingRoom(): ?bool;

    public function getOpeningMonday(): ?string;

    public function getOpeningTuesday(): ?string;

    public function getOpeningWednesday(): ?string;

    public function getOpeningThursday(): ?string;

    public function getOpeningFriday(): ?string;

    public function getOpeningSaturday(): ?string;

    public function getOpeningSunday(): ?string;

    public function getMaxWeight(): ?float;
}
