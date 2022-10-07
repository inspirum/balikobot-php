<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Attribute;

trait ForeignCountryDeliveryData
{
    public function setInvoiceNumber(string $invoiceNumber): void
    {
        $this->offsetSet(Attribute::INVOICE_NUMBER, $invoiceNumber);
    }

    public function setGenerateInvoice(bool $value = true): void
    {
        $this->offsetSet(Attribute::GENERATE_INVOICE, (int) $value);
    }

    public function setInvoicePDF(string $pdf): void
    {
        $this->offsetSet(Attribute::INVOICE_PDF, $pdf);
    }

    public function setInvoiceType(string $type): void
    {
        $this->offsetSet(Attribute::INVOICE_TYPE, $type);
    }

    public function setTermsOfTrade(string $terms): void
    {
        $this->offsetSet(Attribute::TERMS_OF_TRADE, $terms);
    }

    public function setTermsOfTradeLocation(string $location): void
    {
        $this->offsetSet(Attribute::TERMS_OF_TRADE_LOCATION, $location);
    }

    /**
     * @param array<string,mixed> $contentData
     */
    public function setContentData(array $contentData): void
    {
        $this->offsetSet(Attribute::CONTENT_DATA, $contentData);
    }

    public function setContentType(string $contentType): void
    {
        $this->offsetSet(Attribute::CONTENT_TYPE, $contentType);
    }

    public function setContentTypeDescription(string $description): void
    {
        $this->offsetSet(Attribute::CONTENT_TYPE_DESCRIPTION, $description);
    }

    public function setContentPlaceOfCommital(string $place): void
    {
        $this->offsetSet(Attribute::CONTENT_PLACE_OF_COMMITAL, $place);
    }

    public function setContentAdditionalFee(float $fee): void
    {
        $this->offsetSet(Attribute::CONTENT_ADDITIONAL_FEE, $fee);
    }

    public function setContentProductCode(string $code): void
    {
        $this->offsetSet(Attribute::CONTENT_PRODUCE_CODE, $code);
    }

    public function setIBAN(string $bankAccount): void
    {
        $this->offsetSet(Attribute::IBAN, $bankAccount);
    }

    public function setSWIFT(string $bankAccount): void
    {
        $this->offsetSet(Attribute::SWIFT, $bankAccount);
    }

    public function setNoteInvoice(string $note): void
    {
        $this->offsetSet(Attribute::NOTE_INVOICE, $note);
    }
}
