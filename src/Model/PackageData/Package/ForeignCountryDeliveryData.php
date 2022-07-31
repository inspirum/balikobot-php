<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Option;

trait ForeignCountryDeliveryData
{
    public function setInvoiceNumber(string $invoiceNumber): void
    {
        $this->offsetSet(Option::INVOICE_NUMBER, $invoiceNumber);
    }

    public function setInvoicePDF(string $pdf): void
    {
        $this->offsetSet(Option::INVOICE_PDF, $pdf);
    }

    public function setTermsOfTrade(string $terms): void
    {
        $this->offsetSet(Option::TERMS_OF_TRADE, $terms);
    }

    /**
     * @param array<string,mixed> $contentData
     */
    public function setContentData(array $contentData): void
    {
        $this->offsetSet(Option::CONTENT_DATA, $contentData);
    }
}
