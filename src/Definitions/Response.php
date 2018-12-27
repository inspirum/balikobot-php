<?php

namespace Inspirum\Balikobot\Definitions;

class Response
{
    /**
     * @var array
     */
    public static $statusCodesErrors = [
        200 => 'OK, operace proběhla v pořádku.',
        208 => 'Položka s doloženým ID již existuje. Data, která jsou navrácena, patří k původnímu záznamu.',
        400 => 'Operace neproběhla v pořádku, zkontrolujte konkrétní data.',
        401 => 'Unauthorized - nejspíš chyba na straně Balikobotu',
        403 => 'Přepravce není pro použité klíče aktivovaný.',
        404 => 'Zásilka neexistuje, nebo již byla zpracována.',
        406 => 'Nedorazila žádná data ke zpracování nebo nemůžou být akceptována.',
        409 => 'Konfigurační soubor daného dopravce nebo profil není vyplněn/konflikt mezi přijatými daty u zásilky.',
        413 => 'Špatný formát dat.',
        423 => 'Tato funkce je dostupná jen pro "živé klíče".',
        501 => 'Technologie toho dopravce ještě není implementována, pro bližší informace sledujte web balikobot.cz.',
        503 => 'Technologie dopravce není dostupná, požadavek bude vyřízen později.',
        500 => 'Nepodařilo se rozeznat chybový stav.',
    ];
    
    /**
     * @var array
     */
    public static $packageDataErrors = [
        406 => 'Nedorazila žádná data ke zpracování.',
        409 => 'Nepovolená kombinace služeb dobírky a výměnné zásilky.',
        413 => 'Špatný formát dat.',
        416 => 'Datum má špatný formát nebo není povoleno.',
    ];
    
    /**
     * @var array
     */
    public static $packageDataKeyErrors = [
        406 => [
            'eid'           => 'Nedorazilo eshop ID.',
            'service_type'  => 'Nedorazilo ID vybrané služby přepravce.',
            'cod_currency'  => 'Nedorazil ISO kód měny.',
            'branch_id'     => 'Nedorazilo ID pobočky.',
            'rec_name'      => 'Nedorazilo jméno příjemce.',
            'rec_street'    => 'Nedorazila ulice s číslem popisným příjemce.',
            'rec_city'      => 'Nedorazilo město příjemce.',
            'rec_zip'       => 'Nedorazilo PSČ příjemce.',
            'rec_country'   => 'Nedorazil ISO kód země příjemce.',
            'rec_phone'     => 'Nedorazilo telefonní číslo příjemce.',
            'rec_email'     => 'Nedorazil email příjemce.',
            'price'         => 'Nedorazila udaná cena zásilky.',
            'vs'            => 'Nedorazil variabilní symbol pro dobírkovou zásilku.',
            'service_range' => 'Balíček nelze přidat, protože není vyplněna číselná řada v klientské zóně.',
            'config_data'   => 'Balíček nelze přidat, protože chybí potřebná data v klientské zóně.',
            'weight'        => 'Nedorazil údaj o váze zásilky.',
        ],
        409 => [
            'cod_price' => 'Nepovolená kombinace služeb dobírky a výměnné zásilky.',
            'swap'      => 'Nepovolená kombinace služeb dobírky a výměnné zásilky.',
        ],
        413 => [
            'eid'           => 'Eshop ID je delší než je maximální povolená délka.',
            'service_type'  => 'Neznámé ID služby přepravce.',
            'cod_price'     => 'Nepovolená dobírka.',
            'cod_currency'  => 'Nepovolený ISO kód měny.',
            'price'         => 'Nepovolená částka udané ceny.',
            'branch_id'     => 'Neznámé ID pobočky.',
            'rec_email'     => 'Špatný formát emailu příjemce.',
            'order_number'  => 'Sdružená zásilka není povolena.',
            'rec_country'   => 'Nepovolený ISO kód země příjemce.',
            'rec_zip'       => 'Nepovolené PSČ příjemce.',
            'weight'        => 'Neplatný formát váhy/váha překračuje maximální povolenou hodnotu.',
            'swap'          => 'Výměnná zásilka není pro vybranou službu povolena.',
            'rec_phone'     => 'Špatný formát telefonního čísla.',
            'credit_card'   => 'Platba kartou není pro tuto službu/pobočku povolena.',
            'service_range' => 'Balíček nelze přidat, protože číselná řada v klientské zóně je již přečerpaná.',
        ],
        416 => [
            'delivery_date' => 'Datum má špatný formát nebo není povoleno.'
        ],
    ];
}
