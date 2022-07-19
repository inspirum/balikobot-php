<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Option;

trait ForeignCountryDeliveryData
{
    /**
     * @param string $invoiceNumber
     *
     * @return void
     */
    public function setInvoiceNumber(string $invoiceNumber): void
    {
        $this->offsetSet(Option::INVOICE_NUMBER, $invoiceNumber);
    }

    /**
     * @param string $pdf
     *
     * @return void
     */
    public function setInvoicePDF(string $pdf): void
    {
        $this->offsetSet(Option::INVOICE_PDF, $pdf);
    }

    /**
     * @param string $terms
     *
     * @return void
     */
    public function setTermsOfTrade(string $terms): void
    {
        $this->offsetSet(Option::TERMS_OF_TRADE, $terms);
    }

    /**
     * @param array<string,string|int|float|bool> $contentData
     *
     * @return void
     */
    public function setContentData(array $contentData): void
    {
        $this->offsetSet(Option::CONTENT_DATA, $contentData);
    }
}
