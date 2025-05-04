<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use DateTimeInterface;
use Inspirum\Balikobot\Definitions\Attribute;

trait ParcelPackageData
{
    public function setMuType(string $muType): void
    {
        $this->offsetSet(Attribute::MU_TYPE, $muType);
    }

    public function setPiecesCount(int $piecesCount): void
    {
        $this->offsetSet(Attribute::PIECES_COUNT, $piecesCount);
    }

    public function setMuTypeOne(string $muType): void
    {
        $this->offsetSet(Attribute::MU_TYPE_ONE, $muType);
    }

    public function setPiecesCountOne(int $piecesCount): void
    {
        $this->offsetSet(Attribute::PIECES_COUNT_ONE, $piecesCount);
    }

    public function setMuTypeTwo(string $muType): void
    {
        $this->offsetSet(Attribute::MU_TYPE_TWO, $muType);
    }

    public function setPiecesCountTwo(int $piecesCount): void
    {
        $this->offsetSet(Attribute::PIECES_COUNT_TWO, $piecesCount);
    }

    public function setMuTypeThree(string $muType): void
    {
        $this->offsetSet(Attribute::MU_TYPE_THREE, $muType);
    }

    public function setPiecesCountThree(int $piecesCount): void
    {
        $this->offsetSet(Attribute::PIECES_COUNT_THREE, $piecesCount);
    }

    public function setWrapBackCount(int $wrapBackCount): void
    {
        $this->offsetSet(Attribute::WRAP_BACK_COUNT, $wrapBackCount);
    }

    public function setWrapBackNote(string $wrapBackNote): void
    {
        $this->offsetSet(Attribute::WRAP_BACK_NOTE, $wrapBackNote);
    }

    public function setAppDisp(bool $appDisp = true): void
    {
        $this->offsetSet(Attribute::APP_DISP, (int) $appDisp);
    }

    public function setContent(string $content): void
    {
        $this->offsetSet(Attribute::CONTENT, $content);
    }

    public function setGetPiecesNumbers(bool $getPiecesNumbers = true): void
    {
        $this->offsetSet(Attribute::GET_PIECES_NUMBERS, (int) $getPiecesNumbers);
    }

    public function setContentOne(string $contentOne): void
    {
        $this->offsetSet(Attribute::CONTENT_ONE, $contentOne);
    }

    public function setContentTwo(string $contentTwo): void
    {
        $this->offsetSet(Attribute::CONTENT_TWO, $contentTwo);
    }

    public function setContentThree(string $contentThree): void
    {
        $this->offsetSet(Attribute::CONTENT_THREE, $contentThree);
    }

    public function setAdrService(bool $adrService = true): void
    {
        $this->offsetSet(Attribute::ADR_SERVICE, (int) $adrService);
    }

    /**
     * @param array<string,string> $adrContent
     */
    public function setAdrContent(array $adrContent): void
    {
        $this->offsetSet(Attribute::ADR_CONTENT, $adrContent);
    }

    public function setVDLService(bool $vdlService): void
    {
        $this->offsetSet(Attribute::VDL_SERVICE, (int) $vdlService);
    }

    public function setContentIssueDate(DateTimeInterface $deliveryDate): void
    {
        $this->offsetSet(Attribute::CONTENT_ISSUE_DATE, $deliveryDate->format('Y-m-d'));
    }

    public function setContentInvoiceNumber(string $number): void
    {
        $this->offsetSet(Attribute::CONTENT_INVOICE_NUMBER, $number);
    }

    public function setContentEAD(string $value): void
    {
        $this->offsetSet(Attribute::CONTENT_EAD, $value);
    }

    public function setContentMRN(string $value): void
    {
        $this->offsetSet(Attribute::CONTENT_MRN, $value);
    }

    public function setEADPdf(string $value): void
    {
        $this->offsetSet(Attribute::EAD_PDF, $value);
    }

    public function setDCLPdf(string $value): void
    {
        $this->offsetSet(Attribute::DCL_PDF, $value);
    }

    public function setEORI(string $value): void
    {
        $this->offsetSet(Attribute::EORI, $value);
    }

    public function setGBEORI(string $value): void
    {
        $this->offsetSet(Attribute::GB_EORI, $value);
    }

    public function setEUEORI(string $value): void
    {
        $this->offsetSet(Attribute::EU_EORI, $value);
    }

    public function setRmaAssociation(string $value): void
    {
        $this->offsetSet(Attribute::RMA_ASSOCIATION, $value);
    }

    public function setPONumber(string $value): void
    {
        $this->offsetSet(Attribute::P_O_NUMBER, $value);
    }
}
