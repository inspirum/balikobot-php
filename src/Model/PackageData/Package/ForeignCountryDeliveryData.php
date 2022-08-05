<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\AttributeType;

trait ForeignCountryDeliveryData
{
    public function setInvoiceNumber(string $invoiceNumber): void
    {
        $this->offsetSet(AttributeType::INVOICE_NUMBER, $invoiceNumber);
    }

    public function setInvoicePDF(string $pdf): void
    {
        $this->offsetSet(AttributeType::INVOICE_PDF, $pdf);
    }

    public function setTermsOfTrade(string $terms): void
    {
        $this->offsetSet(AttributeType::TERMS_OF_TRADE, $terms);
    }

    /**
     * @param array<string,mixed> $contentData
     */
    public function setContentData(array $contentData): void
    {
        $this->offsetSet(AttributeType::CONTENT_DATA, $contentData);
    }
}
