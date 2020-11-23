<?php

namespace Inspirum\Balikobot\Definitions;

final class ServiceType
{
    /**
     * Balík do ruky
     *
     * @var string
     */
    public const CP_DR = 'DR';

    /**
     * Doporučená zásilka Ekonomická
     *
     * @var string
     */
    public const CP_RR = 'RR';

    /**
     * Balík Na poštu
     *
     * @var string
     */
    public const CP_NP = 'NP';

    /**
     * Balík do ruky pro vybrané podavatele
     *
     * @var string
     */
    public const CP_DV = 'DV';

    /**
     * Cenné psaní
     *
     * @var string
     */
    public const CP_VL = 'VL';

    /**
     * Doporučená zásilka Ekonomická - standard
     *
     * @var string
     */
    public const CP_SR = 'SR';

    /**
     * Doporučená zásilka Prioritní
     *
     * @var string
     */
    public const CP_RRP = 'RRP';

    /**
     * Doporučená zásilka Prioritní - standard
     *
     * @var string
     */
    public const CP_SRP = 'SRP';

    /**
     * Doporučený balíček
     *
     * @var string
     */
    public const CP_BA = 'BA';

    /**
     * Cenný balík
     *
     * @var string
     */
    public const CP_BB = 'BB';

    /**
     * Balík nadrozměr
     *
     * @var string
     */
    public const CP_BN = 'BN';

    /**
     * Balík do balíkovny
     *
     * @var string
     */
    public const CP_NB = 'NB';

    /**
     * DE balík Do ruky s garantovaným časem dodání
     *
     * @var string
     */
    public const CP_DT = 'DT';

    /**
     * Balík Do ruky s garantovaným časem dodání v neděli nebo svátek
     *
     * @var string
     */
    public const CP_DS = 'DS';

    /**
     * EMS expresní přeprava po ČR
     *
     * @var string
     */
    public const CP_EE = 'EE';

    /**
     * Balík Expres
     *
     * @var string
     */
    public const CP_BE = 'BE';

    /**
     * RR Doporučená zásilka do zahraničí Prioritní
     *
     * @var string
     */
    public const CP_RZP = 'RZP';

    /**
     * VL Cenné psaní do zahraničí Prioritní
     *
     * @var string
     */
    public const CP_VZP = 'VZP';

    /**
     * EMS Expresní přeprava do zahraničí
     *
     * @var string
     */
    public const CP_EM = 'EM';

    /**
     * CS Standardní balík do zahraničí Prioritní
     *
     * @var string
     */
    public const CP_CSP = 'CSP';

    /**
     * CS Standardní balík do zahraničí Ekonomický
     *
     * @var string
     */
    public const CP_CSE = 'CSE';

    /**
     * CV Cenný balík do zahraničí Prioritní
     *
     * @var string
     */
    public const CP_CVP = 'CVP';

    /**
     * CV Cenný balík do zahraničí Ekonomický
     *
     * @var string
     */
    public const CP_CVE = 'CVE';

    /**
     * Obchodní balík do zahraničí
     *
     * @var string
     */
    public const CP_CE = 'CE';

    /**
     * Obyčejná listovní zásilka mezinárodní
     *
     * @var string
     */
    public const CP_OLZ = 'OLZ';

    /**
     * PPL Parcel Business CZ
     *
     * @var string
     */
    public const PPL_PARCEL_BUSSINESS_CZ = '1';

    /**
     * PPL Parcel Connect (exportní balík)
     *
     * @var string
     */
    public const PPL_CONNECT = '2';

    /**
     * PPL Parcel CZ Dopolední balík
     *
     * @var string
     */
    public const PPL_AFTERNOON = '3';

    /**
     * PPL Parcel CZ Private (soukromý balík)
     *
     * @var string
     */
    public const PPL_PRIVATE = '4';

    /**
     * PPL Parcel CZ Business (firemní balík)
     *
     * @var string
     */
    public const PPL_BUSINESS = '8';

    /**
     * PPL Parcel CZ Private - Večerní doručení
     *
     * @var string
     */
    public const PPL_PRIVATE_EVENING = '9';

    /**
     * PPl Parcel Import
     *
     * @var string
     */
    public const PPL_PARCEL_IMPORT = '11';

    /**
     * PPL Firemní paleta
     *
     * @var string
     */
    public const PPL_BUSINESS_PALETTE = '15';

    /**
     *
     * PPL Soukromá paleta
     *
     * @var string
     */
    public const PPL_PRIVATE_PALETTE = '19';

    /**
     * DPD Classic
     *
     * @var string
     */
    public const DPD_CLASSIC = '1';

    /**
     * DPD Private
     *
     * @var string
     */
    public const DPD_PRIVATE = '2';

    /**
     * DPD Pickup
     *
     * @var string
     */
    public const DPD_PICKUP = '3';

    /**
     * DPD Expresní doručení do 10:00
     *
     * @var string
     */
    public const DPD_EXPRESS_10 = '4';

    /**
     * DPD Expresní doručení do 12:00
     *
     * @var string
     */
    public const DPD_EXPRESS_12 = '5';

    /**
     * DPD Expresní doručení do 18:00
     *
     * @var string
     */
    public const DPD_EXPRESS_18 = '6';

    /**
     * DPD Private večerní doručení
     *
     * @var string
     */
    public const DPD_PRIVATE_EVENING = '7';

    /**
     * DPD Private sobotní doručení
     *
     * @var string
     */
    public const DPD_PRIVATE_SATURDAY = '8';

    /**
     * Soukromá zásilka (B2C)
     * // TODO: rename to B2C
     *
     * @var string
     */
    public const GEIS_PARCEL_PRIVATE = '1';

    /**
     * Firemní zásilka
     * // TODO: rename to B2B
     *
     * @var string
     */
    public const GEIS_PARCEL_BUSINESS = '2';

    /**
     * Mezinárodní zásilka (B2B)
     *
     * @var string
     */
    public const GEIS_PARCEL_BUSINESS_INTERNATIONAL = '3';

    /**
     * Vnitrostátní paletová zásilka B2B
     *
     * @var string
     */
    public const GEIS_CARGO_BUSINESS_NATIONAL = '4';

    /**
     * Mezinárodní paletová zásilka B2B
     *
     * @var string
     */
    public const GEIS_CARGO_BUSINESS_INTERNATIONAL = '5';

    /**
     * Geis Point
     *
     * @var string
     */
    public const GEIS_PARCEL_GEIS_POINT = '6';

    /**
     * Garantované doručení (GAR)
     *
     * @var string
     */
    public const GEIS_PARCEL_GARANTED = '7';

    /**
     * Doručení do 12. hodin (D12)
     *
     * @var string
     */
    public const GEIS_PARCEL_12 = '8';

    /**
     * Mezinárodní zásilka (B2C)
     *
     * @var string
     */
    public const GEIS_PARCEL_PRIVATE_INTERNATIONAL = '9';

    /**
     * Vnitrostátní paletová zásilka B2C
     *
     * @var string
     */
    public const GEIS_CARGO_PRIVATE_NATIONAL = '10';

    /**
     * Mezinárodní paletová zásilka B2C
     *
     * @var string
     */
    public const GEIS_CARGO_PRIVATE_INTERNATIONAL = '11';

    /**
     * Business Parcel (doručení do ruky)
     *
     * @var string
     */
    public const GLS_BUSINESS = '1';

    /**
     * ShopDelivery Service (doručení na výdejní místo)
     *
     * @var string
     */
    public const GLS_SHOP = '2';

    /**
     * Express Parcel (expresní zásilka)
     *
     * @var string
     */
    public const GLS_EXPRESS = '3';

    /**
     * Guaranteed 24 Service Business Parcel
     *
     * @var string
     */
    public const GLS_GUARANTEED24 = '4';

    /**
     * "Guaranteed 24 Service Express Parcel
     *
     * @var string
     */
    public const GLS_GUARANTEED24_EXPRESS = '5';

    /**
     * Guaranteed 24 Service ShopDelivery
     *
     * @var string
     */
    public const GLS_GUARANTEED24_SHOP = '6';

    /**
     * Small Colli 24-CZ
     *
     * @var string
     */
    public const INTIME_SMALL_CZ = '1';

    /**
     * Medium Colli 24-CZ
     *
     * @var string
     */
    public const INTIME_MEDIUM_CZ = '2';

    /**
     * Large Colli 24-CZ
     *
     * @var string
     */
    public const INTIME_LARGE_CZ = '3';

    /**
     * Poštomat CZ
     *
     * @var string
     */
    public const INTIME_POSTOMAT_CZ = '4';

    /**
     * Poštomat SK
     *
     * @var string
     */
    public const INTIME_POSTOMAT_SK = '5';

    /**
     * Large Colli 48-SK
     *
     * @var string
     */
    public const INTIME_LARGE_SK = '6';

    /**
     * Extra Large Colli 24-CZ
     *
     * @var string
     */
    public const INTIME_EXTRA_CZ = '7';

    /**
     * Parcel EU
     *
     * @var string
     */
    public const INTIME_PARCEL_EU = '8';

    /**
     * Parcel EU+
     *
     * @var string
     */
    public const INTIME_PARCEL_EU_PLUS = '9';

    /**
     * 24 hodin (Standard)
     *
     * @var string
     */
    public const TOPTRANS_STANDARD = '1';

    /**
     * Toptime
     *
     * @var string
     */
    public const TOPTRANS_TOPTIME = '2';

    /**
     * Privat
     *
     * @var string
     */
    public const TOPTRANS_PRIVATE = '3';

    /**
     * Weekend
     *
     * @var string
     */
    public const TOPTRANS_WEEKEND = '4';

    /**
     * Osobní odběr
     *
     * @var string
     */
    public const TOPTRANS_PERSONAL = '5';

    /**
     * Po avizaci
     *
     * @var string
     */
    public const TOPTRANS_NOTICE = '6';

    /**
     * Balík na adresu – zmluvní zákazníci
     *
     * @var string
     */
    public const SP_BZA = 'BZA';

    /**
     * Balík na poštu – zmluvní zákazníci
     *
     * @var string
     */
    public const SP_BZP = 'BZP';

    /**
     * Balík do BalíkoBOXu
     *
     * @var string
     */
    public const SP_BZB = 'BZB';

    /**
     * Expres kuriér na adresu
     *
     * @var string
     */
    public const SP_EXA = 'EXA';

    /**
     * Expres kuriér na poštu
     *
     * @var string
     */
    public const SP_EXP = 'EXP';

    /**
     * Expres kuriér do BalíkoBOXu
     *
     * @var string
     */
    public const SP_EXB = 'EXB';

    /**
     * Balík na adresu
     *
     * @var string
     */
    public const SP_BNA = 'BNA';

    /**
     * Balík na poštu
     *
     * @var string
     */
    public const SP_BNP = 'BNP';

    /**
     * Balík do BalíkoBOXu
     *
     * @var string
     */
    public const SP_BNB = 'BNB';

    /**
     * Doporučený list
     *
     * @var string
     */
    public const SP_RRA = 'RRA';

    /**
     * Expres (vnitrostátní zásilky)
     *
     * @var string
     */
    public const SPS_EXPRESS = '1';

    /**
     * Expres do 12:00 (vnitrostátní zásilky)
     *
     * @var string
     */
    public const SPS_EXPRESS_12 = '2';

    /**
     * Expres do 09:00 (vnitrostátní zásilky)
     *
     * @var string
     */
    public const SPS_EXPRESS_9 = '3';

    /**
     * Export (mezinárodní zásilky)
     *
     * @var string
     */
    public const SPS_INTERNATIONAL = '4';

    /**
     * Uloženka
     *
     * @var string
     */
    public const ULOZENKA_ULOZENKA = '1';

    /**
     * Slovenská pošta
     *
     * @var string
     */
    public const ULOZENKA_SP = '2';

    /**
     * DPD Classic na Slovensko
     *
     * @var string
     */
    public const ULOZENKA_DPD_CLASSIC_SK = '3';

    /**
     * DPD Private pro ČR a SK
     *
     * @var string
     */
    public const ULOZENKA_DPD_PRIVATE = '4';

    /**
     * DPD ParcelShop
     *
     * @var string
     */
    public const ULOZENKA_DPD_PARCEL = '5';

    /**
     * Balík do ruky – Česká pošta,
     *
     * @var string
     */
    public const ULOZENKA_CP_DR = '6';

    /**
     * Balík na poštu – Česká pošta
     *
     * @var string
     */
    public const ULOZENKA_CP_NP = '7';

    /**
     * Partner
     *
     * @var string
     */
    public const ULOZENKA_PARTNER = '11';

    /**
     * Doručení na adresu D+1
     *
     * @var string
     */
    public const ULOZENKA_D1 = '17';

    /**
     * Expres Kurýr SK
     *
     * @var string
     */
    public const ULOZENKA_EXPRESS_COURRIER = '19';

    /**
     * Expres na poštu SK
     *
     * @var string
     */
    public const ULOZENKA_EXPRESS_SK = '20';

    /**
     * BalíkoBOX SK
     *
     * @var string
     */
    public const ULOZENKA_BALIKOBOX_SK = '21';

    /**
     * Depo SK
     *
     * @var string
     */
    public const ULOZENKA_DEPO_SK = '22';

    /**
     * Výdejní místa Česká republika
     *
     * @var string
     */
    public const ZASILKOVNA_VMCZ = 'VMCZ';

    /**
     * Výdejní místa Slovenská republika
     *
     * @var string
     */
    public const ZASILKOVNA_VMSK = 'VMSK';

    /**
     * Výdejní místa Maďarsko
     *
     * @var string
     */
    public const ZASILKOVNA_VMHU = 'VMHU';

    /**
     * Výdejní místa Polsko
     *
     * @var string
     */
    public const ZASILKOVNA_VMPL = 'VMPL';

    /**
     * Výdejní místa Rumunsko
     *
     * @var string
     */
    public const ZASILKOVNA_VMRO = 'VMRO';

    /**
     * AT Rakouská pošta HD
     *
     * @var string
     */
    public const ZASILKOVNA_AT_POST_HD = '80';

    /**
     * AT DPD HD
     *
     * @var string
     */
    public const ZASILKOVNA_AT_DPD_HD = '6830';

    /**
     * BE Belgická pošta PP
     *
     * @var string
     */
    public const ZASILKOVNA_BE_POST_PP = '7910';

    /**
     * BE Belgická pošta HD
     *
     * @deprecated Will be removed in v5.0
     * @see        \Inspirum\Balikobot\Definitions\ServiceType::ZASILKOVNA_BE_POST_HD
     *
     * @var string
     */
    public const ZASILKOVNA_BE_BE_POST_HD = '7909';

    /**
     * BE Nizozemská pošta HD
     *
     * @deprecated Will be removed in v5.0 (change value)
     * @see        \Inspirum\Balikobot\Definitions\ServiceType::ZASILKOVNA_BE_NL_POST_HD
     *
     * @var string
     */
    public const ZASILKOVNA_BE_POST_HD = '4832';

    /**
     * BE Nizozemská pošta HD
     *
     * @var string
     */
    public const ZASILKOVNA_BE_NL_POST_HD = '4832';

    /**
     * BG Econt HD
     *
     * @var string
     */
    public const ZASILKOVNA_BG_ECONT_HD = '6006';

    /**
     * BG Econt PP
     *
     * @var string
     */
    public const ZASILKOVNA_BG_ECONT_PP = '7377';

    /**
     * BG Speedy PP
     *
     * @var string
     */
    public const ZASILKOVNA_BG_SPEEDY_PP = '4017';

    /**
     * BG Speedy HD
     *
     * @var string
     */
    public const ZASILKOVNA_BG_SPEEDY_HD = '4015';

    /**
     * BG Econt Box
     *
     * @var string
     */
    public const ZASILKOVNA_BG_ECONT_BOX = '7378';

    /**
     * CZ Česká pošta HD
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_POST_HD = '13';

    /**
     * CZ - Nejvýhodnější doručení na adresu
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_COURIER_HD = '106';

    /**
     * Expresní doručení Praha
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_EXPRESS_PRAHA_HD = '257';

    /**
     * Expresní doručení Brno
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_EXPRESS_BRNO_HD = '136';

    /**
     * Expresní doručení Ostrava
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_EXPRESS_OSTRAVA_HD = '134';

    /**
     * DE Německá pošta DHL HD
     *
     * @var string
     */
    public const ZASILKOVNA_DE_POST_HD = '111';

    /**
     * Německo Hermes PP
     *
     * @var string
     */
    public const ZASILKOVNA_DE_HERMES_PP = '6828';

    /**
     * DE Hermes Home
     *
     * @var string
     */
    public const ZASILKOVNA_DE_HERMES_HD = '6373';

    /**
     * DK Post Nord Home
     *
     * @var string
     */
    public const ZASILKOVNA_DK_POST_NORD_HD = '4993';
    /**
     * DK Post Nord PP
     *
     * @var string
     */
    public const ZASILKOVNA_DK_POST_NORD_PP = '4994';

    /**
     * EE Omniva Home
     *
     * @var string
     */
    public const ZASILKOVNA_EE_OMNIVA_HD = '5060';

    /**
     * EE Omniva pickup
     *
     * @var string
     */
    public const ZASILKOVNA_EE_OMNIVA_PP = '5061';

    /**
     * EE Omniva Box
     *
     * @var string
     */
    public const ZASILKOVNA_EE_OMNIVA_BOX = '5062';

    /**
     * ES Correos HD
     *
     * @var string
     */
    public const ZASILKOVNA_ES_CORREOS_HD = '4638';

    /**
     * ES MRW Home
     *
     * @var string
     */
    public const ZASILKOVNA_ES_MRW_HD = '4653';

    /**
     * FI Post Nord Home
     *
     * @var string
     */
    public const ZASILKOVNA_FI_POST_NORD_HP = '4830';

    /**
     * FI Post Nord Pickup Point
     *
     * @var string
     */
    public const ZASILKOVNA_FI_POST_NORD_PP = '4828';

    /**
     * FR Mondial PP
     *
     * @var string
     */
    public const ZASILKOVNA_FR_MONDIAL_PP = '4876';

    /**
     * Francie Colissimo Home
     *
     * @var string
     */
    public const ZASILKOVNA_FR_COLISSIMO_HD = '4309';

    /**
     * Spojené království Hermes
     *
     * @var string
     */
    public const ZASILKOVNA_GB_HERMES_HD = '3885';

    /**
     * Spojené království Royal Mail 24
     *
     * @var string
     */
    public const ZASILKOVNA_GB_ROYAL_MAIL_24_HD = '4856';

    /**
     * Spojené království Royal Mail 48
     *
     * @var string
     */
    public const ZASILKOVNA_GB_ROYAL_MAIL_48_HD = '4857';

    /**
     * GR ACS HD
     *
     * @var string
     */
    public const ZASILKOVNA_GR_ACS_HD = '7770';

    /**
     * GR ACS PP
     *
     * @var string
     */
    public const ZASILKOVNA_GR_ACS_PP = '7788';

    /**
     * Recko Speedy Home
     *
     * @var string
     */
    public const ZASILKOVNA_GR_SPEEDY_HD = '4738';

    /**
     * Chorvatsko DPD Home
     *
     * @var string
     */
    public const ZASILKOVNA_HR_DPD_HD = '4646';

    /**
     * Chorvatská Pošta - Výdejní místo
     *
     * @var string
     */
    public const ZASILKOVNA_HR_POST_PP = '4635';

    /**
     * Chorvatská Pošta - doručení na adresu
     *
     * @var string
     */
    public const ZASILKOVNA_HR_POST_HD = '4634';

    /**
     * Maďarsko Express One (Transoflex)
     *
     * @var string
     */
    public const ZASILKOVNA_HU_EXPRESS_ONE_HD = '151';

    /**
     * Maďarsko DPD
     *
     * @var string
     */
    public const ZASILKOVNA_HU_DPD_HD = '805';

    /**
     * HU - best delivery solution
     *
     * @var string
     */
    public const ZASILKOVNA_HU_COURIER_HD = '4159';

    /**
     * Maďarská pošta
     *
     * @var string
     */
    public const ZASILKOVNA_HU_POST_HD = '763';

    /**
     * Švýcarsko-Lichtenštejnská Pošta - prioritní
     *
     * @var string
     */
    public const ZASILKOVNA_CH_POST_PRIORITY_HD = '3870';

    /**
     * Švýcarsko-Lichtejnštejnská Pošta
     *
     * @var string
     */
    public const ZASILKOVNA_CH_POST_HD = '3294';

    /**
     * Irsko Hermes
     *
     * @var string
     */
    public const ZASILKOVNA_IE_HERMES_HD = '4524';

    /**
     * Itálie GLS
     *
     * @var string
     */
    public const ZASILKOVNA_IT_GLS_HD = '2726';

    /**
     * LT Omniva Box
     *
     * @var string
     */
    public const ZASILKOVNA_LT_OMNIVA_BOX = '5066';

    /**
     * LT Omniva Home
     *
     * @var string
     */
    public const ZASILKOVNA_LT_OMNIVA_HD = '5065';

    /**
     * LU Lucemburská pošta HD
     *
     * @var string
     */
    public const ZASILKOVNA_LU_POST_HD = '8125';

    /**
     * LU DPD
     *
     * @var string
     */
    public const ZASILKOVNA_LU_DPD_HD = '4834';

    /**
     * LV Omniva Box
     *
     * @var string
     */
    public const ZASILKOVNA_LV_OMNIVA_BOX = '5064';

    /**
     * LV Omniva Home
     *
     * @var string
     */
    public const ZASILKOVNA_LV_OMNIVA_HD = '5063';

    /**
     * NL DHL HD
     *
     * @var string
     */
    public const ZASILKOVNA_NL_DHL_HD = '8000';

    /**
     * NL Post
     *
     * @var string
     */
    public const ZASILKOVNA_NL_POST_HD = '4329';

    /**
     * NL DHL PP
     *
     * @var string
     */
    public const ZASILKOVNA_NL_DHL_PP = '8001';

    /**
     * Polská pošta 24h
     *
     * @var string
     */
    public const ZASILKOVNA_PL_POST_24_HD = '1438';

    /**
     * Polská pošta
     *
     * @var string
     */
    public const ZASILKOVNA_PL_POST_48_HD = '272';

    /**
     * Polsko DPD
     *
     * @var string
     */
    public const ZASILKOVNA_PL_DPD_HD = '1406';

    /**
     * PL - best delivery solution
     *
     * @var string
     */
    public const ZASILKOVNA_PL_COURIER_HD = '4162';

    /**
     * Polsko Paczkomaty
     *
     * @var string
     */
    public const ZASILKOVNA_PL_INPOST_PACZKOMATY_BOX = '3060';

    /**
     * Polsko InPost
     *
     * @var string
     */
    public const ZASILKOVNA_PL_INPOST_HD = '3603';

    /**
     * PT MRW Home
     *
     * @var string
     */
    public const ZASILKOVNA_PT_MRW_HD = '4655';

    /**
     * RO - best delivery solution
     *
     * @var string
     */
    public const ZASILKOVNA_RO_COURIER_HD = '4161';

    /**
     * Rumunsko Cargus
     *
     * @var string
     */
    public const ZASILKOVNA_RO_URGENT_CARGUS_HD = '590';

    /**
     * Rumunsko DPD
     *
     * @var string
     */
    public const ZASILKOVNA_RO_DPD_HD = '836';

    /**
     * Rumunsko FAN
     *
     * @var string
     */
    public const ZASILKOVNA_RO_FAN_COURIER_HD = '762';

    /**
     * Ruská pošta
     *
     * @var string
     */
    public const ZASILKOVNA_RU_POST_PP = '4559';

    /**
     * RU Post Registered Packet
     *
     * @var string
     */
    public const ZASILKOVNA_RU_POST_RECOMMENDED_PP = '5102';

    /**
     * RU Post EMS
     *
     * @var string
     */
    public const ZASILKOVNA_RU_EMS_HD = '5101';

    /**
     * SE Post Nord pp
     *
     * @var string
     */
    public const ZASILKOVNA_SE_POST_NORD_PP = '4826';

    /**
     * SE Post Nord Home
     *
     * @var string
     */
    public const ZASILKOVNA_SE_POST_NORD_HD = '4827';

    /**
     * SI DPD Home
     *
     * @var string
     */
    public const ZASILKOVNA_SI_DPD_HD = '4949';

    /**
     * SI DPD Pickup
     *
     * @var string
     */
    public const ZASILKOVNA_SI_DPD_PP = '4950';

    /**
     * Expresné doručenie Bratislava
     *
     * @var string
     */
    public const ZASILKOVNA_SK_EXPRESS_BRATISLAVA_HD = '132';

    /**
     * SK - Best delivery solution
     *
     * @var string
     */
    public const ZASILKOVNA_SK_COURIER_HD = '131';

    /**
     * Slovenská pošta
     *
     * @var string
     */
    public const ZASILKOVNA_SK_POST_HD = '16';

    /**
     * Ukrajina Nova Poshta
     *
     * @var string
     */
    public const ZASILKOVNA_UA_NOVA_POSHTA_PP = '3616';

    /**
     * Ukrajina Rosan
     *
     * @var string
     */
    public const ZASILKOVNA_UA_ROSAN_HD = '1160';

    /**
     * DHL
     *
     * @var string
     */
    public const PBH_DHL = '1';

    /**
     * GLS
     *
     * @var string
     */
    public const PBH_GLS = '2';

    /**
     * UPS
     *
     * @var string
     */
    public const PBH_UPS = '3';

    /**
     * Slovenská pošta
     *
     * @var string
     */
    public const PBH_SP = '4';

    /**
     * Transoflex
     *
     * @var string
     */
    public const PBH_TRANSOFLEX = '5';

    /**
     * Maďarská pošta
     *
     * @var string
     */
    public const PBH_MP = '6';

    /**
     * Cargus
     *
     * @var string
     */
    public const PBH_CARGUS = '7';

    /**
     * Rakouská pošta
     *
     * @var string
     */
    public const PBH_RP = '8';

    /**
     * Česká pošta – Balík do ruky
     *
     * @var string
     */
    public const PBH_CP_DR = '9';

    /**
     * Česká pošta – Balík na poštu
     *
     * @var string
     */
    public const PBH_CP_NP = '10';

    /**
     * PPL
     *
     * @var string
     */
    public const PBH_PPL = '11';

    /**
     * DPD
     *
     * @var string
     */
    public const PBH_DPD = '12';

    /**
     * Polská pošta
     *
     * @var string
     */
    public const PBH_PP = '13';

    /**
     * polský Inpost Kurier
     *
     * @var string
     */
    public const PBH_INPOST_KURIER = '14';

    /**
     * FAN Courier
     *
     * @var string
     */
    public const PBH_FAN_KURIER = '15';

    /**
     * Hermes
     *
     * @var string
     */
    public const PBH_HERMES = '16';

    /**
     * Speedy
     *
     * @var string
     */
    public const PBH_SPEEDY = '17';

    /**
     * Colissimo
     *
     * @var string
     */
    public const PBH_COLISSIMO = '18';

    /**
     * Meest
     *
     * @var string
     */
    public const PBH_MEEST = '19';

    /**
     * Nova Poshta
     *
     * @var string
     */
    public const PBH_NOBA_POSHTA = '20';

    /**
     * Econt
     *
     * @var string
     */
    public const PBH_ECONT = '21';

    /**
     * ACS
     *
     * @var string
     */
    public const PBH_ACS = '22';

    /**
     * Correos
     *
     * @var string
     */
    public const PBH_CORREOS = '23';

    /**
     * 123 Kuriér
     *
     * @var string
     */
    public const PBH_123_KURIER = '24';

    /**
     * Worlwide zásilky
     *
     * @var string
     */
    public const DHL_WORLDWIDE = '1';

    /**
     * Express Worldwide dokumenty
     *
     * @var string
     */
    public const DHL_EXPRESS_DOCUMENTS = '2';

    /**
     * Express Worldwide 9:00
     *
     * @var string
     */
    public const DHL_EXPRESS_WORLDWIDE_9 = '3';

    /**
     * Express Worldwide 12:00
     *
     * @var string
     */
    public const DHL_EXPRESS_WORLDWIDE_12 = '4';

    /**
     * Economy Select
     *
     * @var string
     */
    public const DHL_ECONOMY = '5';

    /**
     * Domestic Express 12:00
     *
     * @var string
     */
    public const DHL_DOMESTIC_12 = '6';

    /**
     * Domestic Express
     *
     * @var string
     */
    public const DHL_DOMESTIC_EXPRESS = '7';

    /**
     * Express
     *
     * @var string
     */
    public const UPS_EXPRESS = '1';

    /**
     * Express Saver
     *
     * @var string
     */
    public const UPS_EXPRESS_SAVER = '2';

    /**
     * Standard
     *
     * @var string
     */
    public const UPS_STANDARD = '3';

    /**
     * Expedited
     *
     * @var string
     */
    public const UPS_EXPEDITED = '4';

    /**
     * Express
     *
     * @var string
     */
    public const TNT_EXPRESS = '1';

    /**
     * Express 9:00
     *
     * @var string
     */
    public const TNT_EXPRESS_9 = '2';

    /**
     * Express 12:00
     *
     * @var string
     */
    public const TNT_EXPRESS_12 = '3';

    /**
     * Economy Express
     *
     * @var string
     */
    public const TNT_ECONOMY_EXPRESS = '4';

    /**
     * Night Express 8:00
     *
     * @var string
     */
    public const TNT_NIGHT_EXPRESS_8 = '5';

    /**
     * Economy Express 12:00
     *
     * @var string
     */
    public const TNT_ECONOMY_EXPRESS_12 = '6';

    /**
     * Express 10:00
     *
     * @var string
     */
    public const TNT_EXPRESS_10 = '7';

    /**
     * Express (Documents)
     *
     * @var string
     */
    public const TNT_EXPRESS_DOCUMENTS = '8';

    /**
     * Express 9:00 (Documents)
     *
     * @var string
     */
    public const TNT_EXPRESS_DOCUMENTS_9 = '9';

    /**
     * Express 10:00 (Documents)
     *
     * @var string
     */
    public const TNT_EXPRESS_DOCUMENTS_10 = '10';

    /**
     * Express 12:00 (Documents)
     *
     * @var string
     */
    public const TNT_EXPRESS_DOCUMENTS_12 = '11';

    /**
     * Night Express 12:00
     *
     * @var string
     */
    public const TNT_NIGHT_EXPRESS_12 = '12';

    /**
     * Night Express 06:00
     *
     * @var string
     */
    public const TNT_NIGHT_EXPRESS_6 = '13';

    /**
     * Night Express 07:00
     *
     * @var string
     */
    public const TNT_NIGHT_EXPRESS_7 = '14';

    /**
     * Night Express 14:00
     *
     * @var string
     */
    public const TNT_NIGHT_EXPRESS_14 = '15';

    /**
     * Special economy express
     *
     * @var string
     */
    public const TNT_SPECIAL_ECONOMY_EXPRESS = '16';

    /**
     * Priority Goods 9:00
     *
     * @var string
     */
    public const GW_PRIORITY_9 = 'P9';

    /**
     * Priority Goods 12:00
     *
     * @var string
     */
    public const GW_PRIORITY_12 = 'P12';

    /**
     * Priority Goods 16:00
     *
     * @var string
     */
    public const GW_PRIORITY_16 = 'P16';

    /**
     * Direct Goods
     *
     * @var string
     */
    public const GW_DIRECT_GOODS = 'WDG';

    /**
     * Pick Up
     *
     * @var string
     */
    public const GW_PICKUP = 'BES';

    /**
     * Pickup by Consignee
     *
     * @var string
     */
    public const GW_PICKUP_BY_CONSIGNEE = 'SA';

    /**
     * Domestic PRON
     *
     * @var string
     */
    public const GW_DOMESTIC = 'W24';

    /**
     * HDS - Home Delivery Services
     *
     * @var string
     */
    public const GW_HOME_DELIVERY = 'HDS';

    /**
     * Export PROI
     *
     * @var string
     */
    public const GW_EXPORT = 'EUR';

    /**
     * Domestic PRON
     *
     * @var string
     */
    public const GW_W24 = 'W24';

    /**
     * Domestic 8:00 - 12:00
     *
     * @var string
     */
    public const GW_D8 = 'D8';

    /**
     * Domestic 12:00 - 14:00
     *
     * @var string
     */
    public const GW_D12 = 'D12';

    /**
     * Domestic 14:00 - 18:00
     *
     * @var string
     */
    public const GW_D14 = 'D14';

    /**
     * Export PROI
     *
     * @var string
     */
    public const GW_EUR = 'EUR';

    /**
     * Standard
     *
     * @var string
     */
    public const MESSENGER_STANDARD = '100';

    /**
     * Extreme
     *
     * @var string
     */
    public const MESSENGER_EXTREME = '102';

    /**
     * Express
     *
     * @var string
     */
    public const MESSENGER_EXPRESS = '103';

    /**
     * Same day
     *
     * @var string
     */
    public const MESSENGER_SAME_DAY = '104';

    /**
     * Overnight Economy
     *
     * @var string
     */
    public const MESSENGER_OVERNIGHT_ECONOMY = '106';

    /**
     * Overnight Express
     *
     * @var string
     */
    public const MESSENGER_OVERNIGHT_EXPRESS = '107';

    /**
     * Direct
     *
     * @var string
     */
    public const MESSENGER_DIRECT = '108';

    /**
     * DHL Paket
     *
     * @var string
     */
    public const DHLDE_PAKET = '1';

    /**
     * DHL Paket Taggleich
     *
     * @var string
     */
    public const DHLDE_PAKET_TAGGLEICH = '2';

    /**
     * DHL Paket International
     *
     * @var string
     */
    public const DHLDE_PAKET_INTERNATIONAL = '3';

    /**
     * DHL Europaket
     *
     * @var string
     */
    public const DHLDE_EUROPAKET = '4';

    /**
     * DHL Paket Connect
     *
     * @var string
     */
    public const DHLDE_PAKET_CONNECT = '5';

    /**
     * FedEx International Priority
     *
     * @var string
     */
    public const FEDEX_INTERNATIONAL = '1';

    /**
     * FedEx International Economy
     *
     * @var string
     */
    public const FEDEX_ECONOMY = '2';

    /**
     * @return array<string>
     */
    public static function cp(): array
    {
        return [
            self::CP_DR,
            self::CP_RR,
            self::CP_SR,
            self::CP_RRP,
            self::CP_SRP,
            self::CP_NP,
            self::CP_VL,
            self::CP_DV,
            self::CP_BA,
            self::CP_BB,
            self::CP_BN,
            self::CP_NB,
            self::CP_DT,
            self::CP_DS,
            self::CP_EE,
            self::CP_BE,
            self::CP_RZP,
            self::CP_VZP,
            self::CP_EM,
            self::CP_CSP,
            self::CP_CSE,
            self::CP_CVP,
            self::CP_CVE,
            self::CP_CE,
            self::CP_OLZ,
        ];
    }

    /**
     * @return array<string>
     */
    public static function dpd(): array
    {
        return [
            self::DPD_CLASSIC,
            self::DPD_PRIVATE,
            self::DPD_PICKUP,
            self::DPD_EXPRESS_10,
            self::DPD_EXPRESS_12,
            self::DPD_EXPRESS_18,
            self::DPD_PRIVATE_EVENING,
            self::DPD_PRIVATE_SATURDAY,
        ];
    }

    /**
     * @return array<string>
     */
    public static function dhl(): array
    {
        return [
            self::DHL_WORLDWIDE,
            self::DHL_EXPRESS_DOCUMENTS,
            self::DHL_EXPRESS_WORLDWIDE_9,
            self::DHL_EXPRESS_WORLDWIDE_12,
            self::DHL_ECONOMY,
            self::DHL_DOMESTIC_12,
            self::DHL_DOMESTIC_EXPRESS,
        ];
    }

    /**
     * @return array<string>
     */
    public static function geis(): array
    {
        return [
            self::GEIS_PARCEL_PRIVATE,
            self::GEIS_PARCEL_BUSINESS,
            self::GEIS_PARCEL_BUSINESS_INTERNATIONAL,
            self::GEIS_CARGO_BUSINESS_NATIONAL,
            self::GEIS_CARGO_BUSINESS_INTERNATIONAL,
            self::GEIS_PARCEL_GEIS_POINT,
            self::GEIS_PARCEL_GARANTED,
            self::GEIS_PARCEL_12,
            self::GEIS_PARCEL_PRIVATE_INTERNATIONAL,
            self::GEIS_CARGO_PRIVATE_NATIONAL,
            self::GEIS_CARGO_PRIVATE_INTERNATIONAL,
        ];
    }

    /**
     * @return array<string>
     */
    public static function gls(): array
    {
        return [
            self::GLS_BUSINESS,
            self::GLS_SHOP,
            self::GLS_EXPRESS,
            self::GLS_GUARANTEED24,
            self::GLS_GUARANTEED24_EXPRESS,
            self::GLS_GUARANTEED24_SHOP,
        ];
    }

    /**
     * @return array<string>
     */
    public static function intime(): array
    {
        return [
            self::INTIME_SMALL_CZ,
            self::INTIME_MEDIUM_CZ,
            self::INTIME_LARGE_CZ,
            self::INTIME_POSTOMAT_CZ,
            // self::INTIME_POSTOMAT_SK,
            self::INTIME_LARGE_SK,
            self::INTIME_EXTRA_CZ,
            self::INTIME_PARCEL_EU,
            self::INTIME_PARCEL_EU_PLUS,
        ];
    }

    /**
     * @return array<string>
     */
    public static function pbh(): array
    {
        return [
            self::PBH_DHL,
            self::PBH_GLS,
            self::PBH_UPS,
            self::PBH_SP,
            self::PBH_TRANSOFLEX,
            self::PBH_MP,
            self::PBH_CARGUS,
            self::PBH_RP,
            self::PBH_CP_DR,
            self::PBH_CP_NP,
            self::PBH_PPL,
            self::PBH_DPD,
            self::PBH_PP,
            self::PBH_INPOST_KURIER,
            self::PBH_FAN_KURIER,
            self::PBH_HERMES,
            self::PBH_SPEEDY,
            self::PBH_COLISSIMO,
            self::PBH_MEEST,
            self::PBH_NOBA_POSHTA,
            self::PBH_ECONT,
            self::PBH_ACS,
            self::PBH_CORREOS,
            self::PBH_123_KURIER,
        ];
    }

    /**
     * @return array<string>
     */
    public static function ppl(): array
    {
        return [
            self::PPL_CONNECT,
            self::PPL_AFTERNOON,
            self::PPL_PRIVATE,
            self::PPL_BUSINESS,
            self::PPL_PRIVATE_EVENING,
            self::PPL_BUSINESS_PALETTE,
            self::PPL_PRIVATE_PALETTE,
        ];
    }

    /**
     * @return array<string>
     */
    public static function sp(): array
    {
        return [
            self::SP_BZA,
            self::SP_BZP,
            self::SP_BZB,
            self::SP_EXA,
            self::SP_EXP,
            self::SP_EXB,
            self::SP_BNA,
            self::SP_BNP,
            self::SP_BNB,
            self::SP_RRA,
        ];
    }

    /**
     * @return array<string>
     */
    public static function sps(): array
    {
        return [
            self::SPS_EXPRESS,
            self::SPS_EXPRESS_12,
            self::SPS_EXPRESS_9,
            self::SPS_INTERNATIONAL,
        ];
    }

    /**
     * @return array<string>
     */
    public static function topTrans(): array
    {
        return [
            self::TOPTRANS_STANDARD,
            self::TOPTRANS_TOPTIME,
            self::TOPTRANS_PRIVATE,
            self::TOPTRANS_WEEKEND,
            self::TOPTRANS_PERSONAL,
            self::TOPTRANS_NOTICE,
        ];
    }

    /**
     * @return array<string>
     */
    public static function ulozenka(): array
    {
        return [
            self::ULOZENKA_ULOZENKA,
            self::ULOZENKA_SP,
            self::ULOZENKA_DPD_CLASSIC_SK,
            self::ULOZENKA_DPD_PRIVATE,
            self::ULOZENKA_DPD_PARCEL,
            self::ULOZENKA_CP_DR,
            self::ULOZENKA_CP_NP,
            self::ULOZENKA_PARTNER,
            self::ULOZENKA_D1,
            self::ULOZENKA_EXPRESS_COURRIER,
            self::ULOZENKA_EXPRESS_SK,
            self::ULOZENKA_BALIKOBOX_SK,
            self::ULOZENKA_DEPO_SK,
        ];
    }

    /**
     * @return array<string>
     */
    public static function ups(): array
    {
        return [
            self::UPS_EXPRESS,
            self::UPS_EXPRESS_SAVER,
            self::UPS_STANDARD,
            self::UPS_EXPEDITED,
        ];
    }

    /**
     * @return array<mixed>
     */
    public static function zasilkovna(): array
    {
        return [
            self::ZASILKOVNA_VMCZ,
            self::ZASILKOVNA_VMSK,
            self::ZASILKOVNA_VMHU,
            self::ZASILKOVNA_VMPL,
            self::ZASILKOVNA_VMRO,
            self::ZASILKOVNA_AT_DPD_HD,
            self::ZASILKOVNA_AT_POST_HD,
            self::ZASILKOVNA_BE_POST_PP,
            self::ZASILKOVNA_BE_BE_POST_HD,
            self::ZASILKOVNA_BE_NL_POST_HD,
            self::ZASILKOVNA_BG_ECONT_HD,
            self::ZASILKOVNA_BG_ECONT_PP,
            self::ZASILKOVNA_BG_SPEEDY_PP,
            self::ZASILKOVNA_BG_SPEEDY_HD,
            self::ZASILKOVNA_BG_ECONT_BOX,
            self::ZASILKOVNA_CZ_POST_HD,
            self::ZASILKOVNA_CZ_EXPRESS_PRAHA_HD,
            self::ZASILKOVNA_CZ_EXPRESS_BRNO_HD,
            self::ZASILKOVNA_CZ_EXPRESS_OSTRAVA_HD,
            self::ZASILKOVNA_CZ_COURIER_HD,
            self::ZASILKOVNA_DE_POST_HD,
            self::ZASILKOVNA_DE_HERMES_PP,
            self::ZASILKOVNA_DE_HERMES_HD,
            self::ZASILKOVNA_DK_POST_NORD_HD,
            self::ZASILKOVNA_DK_POST_NORD_PP,
            self::ZASILKOVNA_EE_OMNIVA_HD,
            self::ZASILKOVNA_EE_OMNIVA_PP,
            self::ZASILKOVNA_EE_OMNIVA_BOX,
            self::ZASILKOVNA_ES_CORREOS_HD,
            self::ZASILKOVNA_ES_MRW_HD,
            self::ZASILKOVNA_FI_POST_NORD_HP,
            self::ZASILKOVNA_FI_POST_NORD_PP,
            self::ZASILKOVNA_FR_MONDIAL_PP,
            self::ZASILKOVNA_FR_COLISSIMO_HD,
            self::ZASILKOVNA_GB_HERMES_HD,
            self::ZASILKOVNA_GB_ROYAL_MAIL_24_HD,
            self::ZASILKOVNA_GB_ROYAL_MAIL_48_HD,
            self::ZASILKOVNA_GR_ACS_HD,
            self::ZASILKOVNA_GR_ACS_PP,
            self::ZASILKOVNA_GR_SPEEDY_HD,
            self::ZASILKOVNA_HR_DPD_HD,
            self::ZASILKOVNA_HR_POST_PP,
            self::ZASILKOVNA_HR_POST_HD,
            //self::ZASILKOVNA_HU_EXPRESS_ONE_HD,
            self::ZASILKOVNA_HU_DPD_HD,
            self::ZASILKOVNA_HU_COURIER_HD,
            self::ZASILKOVNA_HU_POST_HD,
            self::ZASILKOVNA_CH_POST_PRIORITY_HD,
            self::ZASILKOVNA_CH_POST_HD,
            self::ZASILKOVNA_IE_HERMES_HD,
            self::ZASILKOVNA_IT_GLS_HD,
            self::ZASILKOVNA_LT_OMNIVA_BOX,
            self::ZASILKOVNA_LT_OMNIVA_HD,
            self::ZASILKOVNA_LU_POST_HD,
            self::ZASILKOVNA_LU_DPD_HD,
            self::ZASILKOVNA_LV_OMNIVA_BOX,
            self::ZASILKOVNA_LV_OMNIVA_HD,
            self::ZASILKOVNA_NL_DHL_HD,
            self::ZASILKOVNA_NL_POST_HD,
            self::ZASILKOVNA_NL_DHL_PP,
            self::ZASILKOVNA_PL_POST_24_HD,
            self::ZASILKOVNA_PL_POST_48_HD,
            self::ZASILKOVNA_PL_DPD_HD,
            self::ZASILKOVNA_PL_COURIER_HD,
            self::ZASILKOVNA_PL_INPOST_PACZKOMATY_BOX,
            self::ZASILKOVNA_PL_INPOST_HD,
            self::ZASILKOVNA_PT_MRW_HD,
            self::ZASILKOVNA_RO_COURIER_HD,
            self::ZASILKOVNA_RO_URGENT_CARGUS_HD,
            self::ZASILKOVNA_RO_DPD_HD,
            self::ZASILKOVNA_RO_FAN_COURIER_HD,
            self::ZASILKOVNA_RU_POST_PP,
            self::ZASILKOVNA_RU_POST_RECOMMENDED_PP,
            self::ZASILKOVNA_RU_EMS_HD,
            self::ZASILKOVNA_SE_POST_NORD_PP,
            self::ZASILKOVNA_SE_POST_NORD_HD,
            self::ZASILKOVNA_SI_DPD_HD,
            self::ZASILKOVNA_SI_DPD_PP,
            self::ZASILKOVNA_SK_EXPRESS_BRATISLAVA_HD,
            self::ZASILKOVNA_SK_COURIER_HD,
            self::ZASILKOVNA_SK_POST_HD,
            self::ZASILKOVNA_UA_NOVA_POSHTA_PP,
            self::ZASILKOVNA_UA_ROSAN_HD,
        ];
    }

    /**
     * @return array<string>
     */
    public static function tnt(): array
    {
        return [
            self::TNT_EXPRESS,
            self::TNT_EXPRESS_9,
            self::TNT_EXPRESS_12,
            self::TNT_ECONOMY_EXPRESS,
            self::TNT_NIGHT_EXPRESS_8,
            self::TNT_ECONOMY_EXPRESS_12,
            self::TNT_EXPRESS_10,
            self::TNT_EXPRESS_DOCUMENTS,
            self::TNT_EXPRESS_DOCUMENTS_9,
            self::TNT_EXPRESS_DOCUMENTS_10,
            self::TNT_EXPRESS_DOCUMENTS_12,
            self::TNT_NIGHT_EXPRESS_12,
            self::TNT_NIGHT_EXPRESS_6,
            self::TNT_NIGHT_EXPRESS_7,
            self::TNT_NIGHT_EXPRESS_14,
            self::TNT_SPECIAL_ECONOMY_EXPRESS,
        ];
    }

    /**
     * @return array<string>
     */
    public static function gw(): array
    {
        return [
            self::GW_DOMESTIC,
            self::GW_HOME_DELIVERY,
            self::GW_PRIORITY_9,
            self::GW_PRIORITY_12,
            self::GW_PRIORITY_16,
            self::GW_DIRECT_GOODS,
            self::GW_EXPORT,
            self::GW_PICKUP,
            self::GW_PICKUP_BY_CONSIGNEE,
        ];
    }

    /**
     * @return array<string>
     */
    public static function gwcz(): array
    {
        return [
            self::GW_W24,
            self::GW_D8,
            self::GW_D12,
            self::GW_D14,
            self::GW_EUR,
        ];
    }

    /**
     * @return array<string>
     */
    public static function messenger(): array
    {
        return [
            self::MESSENGER_STANDARD,
            self::MESSENGER_EXTREME,
            self::MESSENGER_EXPRESS,
            self::MESSENGER_SAME_DAY,
            self::MESSENGER_OVERNIGHT_ECONOMY,
            self::MESSENGER_OVERNIGHT_EXPRESS,
            self::MESSENGER_DIRECT,
        ];
    }

    /**
     * @return array<string>
     */
    public static function dhlde(): array
    {
        return [
            self::DHLDE_PAKET,
            self::DHLDE_PAKET_TAGGLEICH,
            self::DHLDE_PAKET_INTERNATIONAL,
            self::DHLDE_EUROPAKET,
            self::DHLDE_PAKET_CONNECT,
        ];
    }

    /**
     * @return array<string>
     */
    public static function fedex(): array
    {
        return [
            self::FEDEX_INTERNATIONAL,
            self::FEDEX_ECONOMY,
        ];
    }

    /**
     * All supported shipper services
     *
     * @return array<string,array<string>>
     */
    public static function all(): array
    {
        return [
            Shipper::CP         => self::cp(),
            Shipper::DPD        => self::dpd(),
            Shipper::DHL        => self::dhl(),
            Shipper::GEIS       => self::geis(),
            Shipper::GLS        => self::gls(),
            Shipper::INTIME     => self::intime(),
            Shipper::PBH        => self::pbh(),
            Shipper::PPL        => self::ppl(),
            Shipper::SP         => self::sp(),
            Shipper::SPS        => self::sps(),
            Shipper::TOPTRANS   => self::topTrans(),
            Shipper::ULOZENKA   => self::ulozenka(),
            Shipper::UPS        => self::ups(),
            Shipper::ZASILKOVNA => self::zasilkovna(),
            Shipper::TNT        => self::tnt(),
            Shipper::GW         => self::gw(),
            Shipper::GWCZ       => self::gwcz(),
            Shipper::MESSENGER  => self::messenger(),
            Shipper::DHLDE      => self::dhlde(),
            Shipper::FEDEX      => self::fedex(),
        ];
    }
}
